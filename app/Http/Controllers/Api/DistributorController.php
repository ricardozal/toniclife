<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\AddressWS;
use App\Models\Address;
use App\Models\DataBank;
use App\Models\Distributor;
use App\Models\NewDistributor;
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

    public function saveNewDistributor(Request $request){

        $street = $request->get('street');
        $zipCode = $request->get('zip_code');
        $extNum = $request->get('ext_num');
        $intNum = $request->get('int_num');
        $colony = $request->get('colony');
        $city = $request->get('city');
        $state = $request->get('state');
        $countryId = $request->get('fk_id_country');
        $name = $request->get('name');
        $email = $request->get('email');
        $maritalStatus = $request->get('marital_status');
        $birthday = $request->get('birthday');
        $birthPlace = $request->get('birth_place');
        $nationality = $request->get('nationality');
        $rfc = $request->get('rfc_or_itin');
        $curp = $request->get('curp_or_ssn');
        $phone1 = $request->get('phone_1');
        $phone2 = $request->get('phone_2');
        $identification = $request->get('no_official_identification');
        $orderId = $request->get('fk_id_order');
        $bankName = $request->get('bank_name');
        $accountName = $request->get('account_name');
        $bankNumber = $request->get('bank_account_number');
        $clabe = $request->get('clabe_routing_bank');

        try {
            \DB::beginTransaction();

            $address = new Address();
            $address->street = $street;
            $address->zip_code = $zipCode;
            $address->ext_num = $extNum;
            $address->int_num = $intNum;
            $address->colony = $colony;
            $address->city = $city;
            $address->state = $state;
            $address->fk_id_country = $countryId;
            $address->saveOrFail();

            $newDistributor = new NewDistributor();
            $newDistributor->name = $name;
            $newDistributor->email = $email;
            $newDistributor->marital_status = $maritalStatus;
            $newDistributor->birthday = $birthday;
            $newDistributor->birth_place = $birthPlace;
            $newDistributor->nationality = $nationality;
            $newDistributor->rfc_or_itin = $rfc;
            $newDistributor->curp_or_ssn = $curp;
            $newDistributor->phone_1 = $phone1;
            $newDistributor->phone_2 = $phone2;
            $newDistributor->no_official_identification = $identification;
            $newDistributor->fk_id_address = $address->id;
            $newDistributor->fk_id_order = $orderId;
            $newDistributor->saveOrFail();

            $bankData = new DataBank();
            $bankData->bank_name = $bankName;
            $bankData->account_name = $accountName;
            $bankData->bank_account_number = $bankNumber;
            $bankData->clabe_routing_bank = $clabe;
            $bankData->fk_id_new_distributor = $newDistributor->id;
            $bankData->saveOrFail();

            \DB::commit();
        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => $e->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Registro exitoso',
            'data' => 'Nuevo distribuidor registrado'
        ]);

    }
}
