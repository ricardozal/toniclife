<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\AddressWS;
use App\Http\Resources\DistributorWS;
use App\Http\Resources\OrderItemWS;
use App\Http\Resources\PromotionWS;
use App\Models\AccumulatedPointsStatus;
use App\Models\Address;
use App\Models\Corporate;
use App\Models\Country;
use App\Models\DataBank;
use App\Models\Distributor;
use App\Models\ExternalGainedPoint;
use App\Models\NewDistributor;
use App\Models\Order;
use App\Models\PointsHistory;
use App\Notifications\OrderProcessed;
use Carbon\Carbon;
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

    public function getOrders($distributorId){

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        $orders = $distributor->orders;

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => OrderItemWS::collection($orders)
        ]);

    }

    public function getPromotions($distributorId){

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        $orders = $distributor->promotions;

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => PromotionWS::collection($orders)
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

            $corporate = Corporate::whereId(1)->first();
            $corporate->notify(new OrderProcessed(new Order(), $newDistributor));

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

    public function getAddress($distributorId,$addressId){

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        $address = $distributor->addresses()->where('address.id', $addressId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => AddressWS::make($address)
        ]);

    }

    public function saveAddress(Request $request, $distributorId){

        $alias = $request->get('alias');
        $street = $request->get('street');
        $zipCode = $request->get('zip_code');
        $extNum = $request->get('ext_num');
        $intNum = $request->get('int_num');
        $colony = $request->get('colony');
        $city = $request->get('city');
        $state = $request->get('state');
        $countryId = $request->get('fk_id_country');
        $addressId = $request->get('addressId');

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        try {
            \DB::beginTransaction();

            if($addressId != 0){

                /** @var Address $address */
                $address = Address::find($addressId);

                $address->street = $street;
                $address->zip_code = $zipCode;
                $address->ext_num = $extNum;
                $address->int_num = $intNum;
                $address->colony = $colony;
                $address->city = $city;
                $address->state = $state;
                $address->fk_id_country = $countryId;
                $address->saveOrFail();

                $distributor->addresses()->updateExistingPivot($addressId,['alias'=> $alias]);
                $distributor->saveOrFail();

            } else {

                /** @var Address $address */
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

                $distributor->addresses()->attach($address->id,['alias'=> $alias, 'selected' => false]);
                $distributor->saveOrFail();

            }

            \DB::commit();

        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => 'Intentelo más tarde'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Bien hecho',
            'data' => 'Dirección guardada'
        ]);

    }

    public function saveFirebaseToken(Request $request, $distributorId){

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        $distributor->firebase_token = $request->get('firebase_token');

        if(!$distributor->save()){
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => 'Intentelo más tarde'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Bien hecho',
            'data' => 'Token guardado'
        ]);

    }

    public function getMyDistributors($distributorId, $orderId){

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        /** @var Order $order */
        $order = Order::find($orderId);

        $distributors = $distributor->distributors()->where('fk_id_country',$order->branch->address->fk_id_country)->get();

        return response()->json([
            'success' => true,
            'message' => 'Bien hecho',
            'data' => DistributorWS::collection($distributors)
        ]);
    }

    public function registerPoints(Request $request){

        $distributors = $request->input('distributors');

        /** @var Order $order */
        $order = Order::find($request->input('order_id'));

        $today = Carbon::now();

        /** @var Distributor $distributorParent */
        $distributorParent = Distributor::find($order->fk_id_distributor);

        $currentDistPointsId = $distributorParent->currentPoints[0]->id;
        /** @var PointsHistory $distPointsHistory */
        $distPointsHistory = PointsHistory::find($currentDistPointsId);

        $count = 0;
        $toniIdsRejected = "";

        foreach ($distributors as $distributorItem){
            foreach ($distributorParent->distributors()->where('fk_id_country', $order->branch->address->fk_id_country)->get() as $childDist) {
                if($childDist->tonic_life_id == $distributorItem['id']){
                    $count++;
                    $toniIdsRejected .= $distributorItem['id'].", ";
                } else {
                    break;
                }
            }
        }

        if($count != count($distributors)){
            return response()->json([
                'success' => false,
                'message' => 'Atención',
                'data' => $count == 0 ? 'Ningún ID Tonic Life ingresado puede ser procesado' : ($count == 1 ? 'Solo el ID Tonic Life '.$toniIdsRejected. ' podrá ser procesado, verifique los demás.' : 'Solo los ID Tonic Life '.$toniIdsRejected. ' podrán ser procesados, verifique los demás.')
            ]);
        }

        try{
            \DB::beginTransaction();

            foreach ($distributors as $distributorItem){

                /** @var Distributor $distributor */
                $distributor = Distributor::whereTonicLifeId($distributorItem['id'])->first();

                foreach ($distributor->accumulatedPointsHistory as $point)
                {
                    $begin = Carbon::parse($point->begin_period);
                    $end = Carbon::parse($point->end_period);
                    if ($today->between($begin,$end))
                    {
                        $point->accumulated_points = $distributor->fk_id_country == Country::MEX ? $point->accumulated_points+$distributorItem['points'] : $point->accumulated_points;
                        $point->accumulated_money = $distributor->fk_id_country == Country::USA ? $point->accumulated_money+$distributorItem['points'] : $point->accumulated_money;
                        $point->save();
                        $point->fk_id_accumulated_points_status = AccumulatedPointsStatus::getPointHistoryStatus($distributor->id);
                        $point->save();

                        $externalPoints = new ExternalGainedPoint();
                        $externalPoints->points = $distributorItem['points'];
                        $externalPoints->fk_id_point_history = $point->id;
                        $externalPoints->fk_id_order = $order->id;
                        $externalPoints->save();

                        $distPointsHistory->accumulated_points = $distributorParent->fk_id_country == Country::MEX ? $distPointsHistory->accumulated_points-$distributorItem['points'] : $distPointsHistory->accumulated_points;
                        $distPointsHistory->accumulated_money = $distributorParent->fk_id_country == Country::USA ? $distPointsHistory->accumulated_money-$distributorItem['points'] : $distPointsHistory->accumulated_money;
                        $distPointsHistory->save();
                        $distPointsHistory->fk_id_accumulated_points_status = AccumulatedPointsStatus::getPointHistoryStatus($distributorParent->id);
                        $distPointsHistory->save();

                    } else{

                        $day = $today->day;
                        $month = $today->month;
                        $year = $today->year;

                        if($day < 26){
                            $monthBefore = Carbon::now()->subMonth()->month;
                            $beginDate = Carbon::create($year,$monthBefore,26);
                            $endDate = Carbon::create($year,$monthBefore,25)->addMonth();
                        } else {
                            $beginDate = Carbon::create($year,$month,26);
                            $endDate = Carbon::create($year,$month,25)->addMonth();
                        }

                        $point = new \App\Models\PointsHistory();
                        $point->begin_period = $beginDate;
                        $point->end_period = $endDate;
                        $point->accumulated_points = $distributor->fk_id_country == Country::MEX ? $distributorItem['points'] : 0;
                        $point->accumulated_money = $distributor->fk_id_country == Country::USA ? $distributorItem['points'] : 0;
                        $point->fk_id_accumulated_points_status = $distributor->fk_id_country == Country::MEX ? 1 : 2;
                        $point->fk_id_distributor = $distributor->id;
                        $point->save();

                        $externalPoints = new ExternalGainedPoint();
                        $externalPoints->points = $distributorItem['points'];
                        $externalPoints->fk_id_point_history = $point->id;
                        $externalPoints->fk_id_order = $order->id;
                        $externalPoints->save();

                        $distPointsHistory->accumulated_points = $distributorParent->fk_id_country == Country::MEX ? $distPointsHistory->accumulated_points-$distributorItem['points'] : $distPointsHistory->accumulated_points;
                        $distPointsHistory->accumulated_money = $distributorParent->fk_id_country == Country::USA ? $distPointsHistory->accumulated_money-$distributorItem['points'] : $distPointsHistory->accumulated_money;
                        $distPointsHistory->save();
                        $distPointsHistory->fk_id_accumulated_points_status = AccumulatedPointsStatus::getPointHistoryStatus($distributorParent->id);
                        $distPointsHistory->save();
                    }
                }

            }

            \DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Todo bien',
                'data' => 'Registro de puntos exitoso'
            ]);

        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => 'Intentelo más tarde'
            ]);
        }

    }
}
