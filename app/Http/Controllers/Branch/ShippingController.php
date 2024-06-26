<?php


namespace App\Http\Controllers\Branch;


use App\Http\Controllers\Controller;
use App\Http\Request\GuideNumberRequest;
use App\Models\Branch;
use App\Models\Distributor;
use App\Models\Movement;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\ShippingGuideNumber;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function index()
    {
        $locale= session()->get('branch.home.index');
        app()->setLocale($locale);
        return view('admin.shipping.shipping.index');
    }

    public function indexContent()
    {

        $order = Order::with(['distributor','status','shippingAddress','branch.address', 'branch', 'guideNumber'])
            ->where('fk_id_shipping_address', '!=', null)
            ->where('fk_id_branch', Auth::user()->branch->id)
            ->whereIn('fk_id_order_status', [OrderStatus::AUTHORIZED, OrderStatus::SENT])
            ->get();

        $query = $order;
        return response()->json([
            'data' => $query
        ]);

    }

    public function guideNumber($orderId)
    {
        $order = Order::find($orderId);

        return view('admin.shipping.shipping.guide_number', [
            'order' => $order
        ]);
    }

    public function guideNumberPost(GuideNumberRequest $request, $orderId){

        /** @var Order $order */
        $order = Order::find($orderId);

        try{
            \DB::beginTransaction();

            $shippingGuideNumberId = $order->fk_id_shipping_guide_number;

            if($shippingGuideNumberId != null){

                /** @var ShippingGuideNumber $shippingGuideNumber */
                $shippingGuideNumber = ShippingGuideNumber::find($shippingGuideNumberId);
                $shippingGuideNumber->fill($request->all());
                $shippingGuideNumber->saveOrFail();

                $title = 'Tu número de guía fue cambiado';
                $body = 'Tu nuevo número de guía es: '.$order->guideNumber->value.' de '.$order->guideNumber->officeParcel->name;

            } else {
                $shippingGuideNumber = new ShippingGuideNumber();
                $shippingGuideNumber->fill($request->all());
                $shippingGuideNumber->saveOrFail();
                $order->fk_id_shipping_guide_number = $shippingGuideNumber->id;
                $order->fk_id_order_status = OrderStatus::SENT;
                $order->saveOrFail();

                $title = 'Tu compra ha sido enviada';
                $body = 'Tu compra con folio '.$order->id.' ha sido enviada, pronto estará en tus manos. Tu número de guía es: '.$order->guideNumber->value.' de '.$order->guideNumber->officeParcel->name;
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
                'message' => 'Proceso completado'
            ]);
        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'error' => $e
            ]);
        }

    }

    public function show($orderId)
    {
        $order = Order::find($orderId);

        return view('admin.order.show',[
            'order' => $order
        ]);
    }
}
