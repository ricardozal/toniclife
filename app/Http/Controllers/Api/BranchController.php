<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\BranchWS;
use App\Models\Address;
use App\Models\Branch;
use App\Models\Product;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function getBranches()
    {
        $branches = Branch::with(['address'])->where('active',true)->get();

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => BranchWS::collection($branches)
        ]);
    }

    public function validateInventory(Request $request){

        $addressId = $request->input('address_id');
        $productsOrder = $request->input('products');
        $branchId = $request->input('branch_id');

        /** @var Branch $branch */
        $branch = null;

        if($branchId == null ){

            /** @var Address $address */
            $address = Address::find($addressId);
            $from = $address->city.','.$address->state;

            $branches = Branch::whereActive(true)->get();

            $distances = [];

            foreach ($branches as $branchItem){

                $to = $branchItem->address->city.','.$branchItem->address->state;
                $distances[] = [
                    'id' => $branchItem->id,
                    'distance' => $this->calculateDistance($from, $to)
                ];

            }

            usort($distances, function($a, $b) {return strcmp($a['distance'], $b['distance']);});

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
                    'data' => ''
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => 'OK'
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
