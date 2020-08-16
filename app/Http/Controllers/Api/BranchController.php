<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\BranchWS;
use App\Models\Address;
use App\Models\Branch;
use App\Models\Distributor;
use App\Models\Product;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function getBranches($distributorId)
    {

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);
        $countryId = $distributor->fk_id_country;

        $branches = Branch::with(['address'])->where('active',true)->whereHas('address',function ($q) use ($countryId) {
            $q->where('fk_id_country',$countryId);
        })->get();

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => BranchWS::collection($branches)
        ]);
    }

    public function validateInventory(Request $request, $distributorId){

        $addressId = $request->input('address_id');
        $productsOrder = $request->input('products');
        $branchId = $request->input('branch_id');

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        foreach ($productsOrder as $product){

            /** @var Product $productValidate */
            $productValidate = Product::find($product['id']);
            if($distributor->fk_id_country != $productValidate->fk_id_country){
                return response()->json([
                    'success' => false,
                    'message' => 'No está permitido comprar productos de un catalogo diferente al de tu país',
                    'data' => null
                ]);
            }
        }

        /** @var Branch $branch */
        $branch = null;

        if($branchId == 0 ){

            /** @var Address $address */
            $address = Address::find($addressId);
            $from = $address->city.','.$address->state.','.$address->country->name;

            $branches = Branch::whereActive(true)->get();

            $distances = [];

            foreach ($branches as $branchItem){

                $to = $branchItem->address->city.','.$branchItem->address->state.','.$branchItem->address->country->name;
                $distances[] = [
                    'id' => $branchItem->id,
                    'distance' => $this->calculateDistance($from, $to)
                ];

            }

            $temp = array_column($distances, 'distance');
            array_multisort($temp, SORT_ASC, $distances);

            $nearestBranchItem = $distances[0];

            $branch = Branch::find($nearestBranchItem['id']);

        } else {

            $branch = Branch::find($branchId);

        }

        // Calculate inventory

        $lackOfOneProduct = [];

        foreach ($productsOrder as $product){
            $lackOfOneProduct[] = $this->checkAvailableStock($branch->id, $product);
        }

        foreach ($lackOfOneProduct as $lackOf){

            if(!$lackOf['available']){

                /** @var Product $product */
                $product = Product::find($lackOf['productId']);

                return response()->json([
                    'success' => false,
                    'message' => 'Inventario insuficiente del producto '.$product->name,
                    'data' => null
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => BranchWS::make($branch)
        ]);

    }

    private function calculateDistance($from, $to){

        $fromAddress = urlencode($from);
        $toAddress = urlencode($to);
        $apiKey= env('API_KEY_GOOGLE_MAPS');
        $data = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$fromAddress&destinations=$toAddress&key=$apiKey&language=en-EN&sensor=false");
        $data = json_decode($data);
        $distance = 0;

        foreach($data->rows[0]->elements as $road) {
            $distance += $road->distance->value;
        }

        return $distance;
    }

    private function checkAvailableStock($branchId, $product){

        /** @var Branch $branch */
        $branch = Branch::find($branchId);

        $productExists = $branch->products()->where('product.id', $product['id'])->first();

        if($productExists != null){
            return ['productId' => $product['id'], 'available' => $productExists->pivot->stock > $product['quantity']];
        } else {
            return ['productId' => $product['id'], 'available' => false];
        }

    }

}
