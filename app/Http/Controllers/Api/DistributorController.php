<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\AddressWS;
use App\Models\Address;
use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function getAddresses($distributorId)
    {
        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        $addresses = $distributor->addresses;

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => AddressWS::collection($addresses)
        ]);

    }

    public function setSelectedAddress(Request $request)
    {
        $distributorId = $request->input('distributor_id');
        $addressId = $request->input('address_id');

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        $addresses = $distributor->addresses;

        foreach ($addresses as $address){
            $distributor->addresses()->updateExistingPivot($address->id, ['selected' => false]);
        }

        $distributor->addresses()->updateExistingPivot($addressId, ['selected' => true]);

        if (!$distributor->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo seleccionar la dirección de envío.'
            ]);
        }

        $distributorCurrent = Distributor::find($distributorId);

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => AddressWS::collection($distributorCurrent->addresses)
        ]);

    }
}
