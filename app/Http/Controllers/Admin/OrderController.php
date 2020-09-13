<?php


namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Corporate;
use App\Models\Movement;
use App\Models\Order;
use App\Models\Distributor;
use App\Models\PaymentMethod;
use App\Models\OrderStatus;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Request\OrderRequest;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.index');
    }

    public function indexContent(Request $request)
    {
        $query = Order::with(['distributor','paymentMethod','status','shippingAddress'])->get();
        return response()->json([
            'data' => $query
        ]);
    }

    public function show($orderId)
    {
        $order = Order::find($orderId);

        return view('admin.order.show',[
            'order' => $order
        ]);
    }


    public function authorizePurchase($orderId){

        /** @var Order $order */
        $order = Order::find($orderId);

        return view('admin.order.authorize',[
            'orderId' => $order->id
        ]);

    }

    public function authorizePost(Request $request, $orderId)
    {
        /** @var Order $order */
        $order = Order::find($orderId);

        /** @var Branch $branch */
        $branch = Branch::find($order->fk_id_branch);

        $title = '';
        $body = '';

        $statusId = $request->input('fk_id_order_status');

        try {
            \DB::beginTransaction();

            $order->fk_id_order_status = $statusId;

            $order->saveOrFail();

            if($statusId == OrderStatus::AUTHORIZED){
                $title = 'Tu número de order de compra fue autorizada';
                $body = 'Tu orden de compra con folio: '.$order->id.' fue autorizada, debes estar atento para el método de pago.';

                $corporate = Corporate::whereId(1)->first();

                $targets = [$corporate->email];

                if($order->external_dist->count() > 0){
                    Mail::send(
                        'Web.mail.order',
                        [
                            'order' => $order,
                            'distributors' => $order->external_dist,
                            'pointsForDistributor' => Distributor::getPointsExternalOrder($order->id)
                        ],
                        function ($msg) use ($targets) {
                            $msg->subject('GJana | Orden de compra');
                            $msg->bcc($targets);
                        }
                    );
                } else {
                    Mail::send(
                        'Web.mail.order',
                        [
                            'order' => $order
                        ],
                        function ($msg) use ($targets) {
                            $msg->subject('GJana | Orden de compra');
                            $msg->bcc($targets);
                        }
                    );
                }


            } elseif ($statusId == OrderStatus::CANCELED){
                $title = 'Tu número de order de compra fue rechazada';
                $body = 'Por alguna razón tu orden de compra fue rechazada, consulta a tu administrador.';

                foreach ($order->products as $product){

                    $currentStock = $branch->products()->where('product.id', $product->id)->first()->pivot->stock;
                    $newStock = $currentStock + $product->pivot->quantity;

                    $branch->products()->updateExistingPivot($product->id,['stock'=> $newStock]);
                    $branch->saveOrFail();

                    $movement = new Movement();
                    $movement->comment = 'Cancelación de venta con folio '.$order->id;
                    $movement->type = 1;
                    $movement->quantity = $product->pivot->quantity;
                    $movement->fk_id_product = $product->id;
                    $movement->saveOrFail();

                }
            }

            $recipients = Distributor::whereActive(true)
                ->where('firebase_token', '!=', null)
                ->where('id', $order->fk_id_distributor)
                ->pluck('firebase_token')->toArray();

            fcm()
                ->to($recipients) // $recipients must an array
                ->notification([
                    'title' => $title,
                    'body' => $body,
                ])
                ->send();

            \DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Guardado correctamente'
            ]);

        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
            ]);
        }
    }
}
