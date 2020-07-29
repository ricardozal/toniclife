<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\BranchWS;
use App\Models\Address;
use App\Models\Branch;
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

        /** @var Address $address */
        $address = Address::find($addressId);
        $address1 = Address::find(22);

        $from = $address->city.','.$address->state;
        $to = $address1->city.','.$address1->state;
        $from = urlencode($from);
        $to = urlencode($to);
        $apiKey= env('API_KEY_GOOGLE_MAPS');
        $data = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&key=$apiKey&language=en-EN&sensor=false");
        $data = json_decode($data);
        dd($data);
        $time = 0;
        $distance = 0;
        foreach($data->rows[0]->elements as $road) {
            $time += $road->duration->value;
            $distance += $road->distance->value;
        }

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => [
                'to' => $data->destination_addresses[0],
                'from' => $data->origin_addresses[0],
                'time' => $time,
                'distance' => $distance
            ]
        ]);

    }
}
