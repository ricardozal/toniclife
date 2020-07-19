<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Request\PromotionRequest;
use App\Http\Request\UpdatePromotionRequest;

use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function index()
    {
        return view('admin.promotion.index');

    }


    public function indexContent(Request $request)
    {
        $promotion = Promotion::with(['country'])->get();
        $query = $promotion;
        return response()->json([
            'data' => $query
         ]);
    }

    public function update($promotionId){
        $promotion = Promotion::find($promotionId);
        return view('admin.promotion.upsert',['promotion' => $promotion]);
    }

    public function create(){
        return view('admin.promotion.upsert');
    }

    public function createPost(PromotionRequest $request)
    {

        $promotion = new Promotion();
        $promotion->fill($request->all());

        $withPoints = $request->input('with_points');
        $isAccumulative =$request->input('is_accumulative');

        if($withPoints != null){
            $promotion->with_points=$withPoints;
        }else{
            $promotion->with_points=0;

        }

        if($isAccumulative != null){
            $promotion->is_accumulative=$isAccumulative;
        }else{
            $promotion->is_accumulative=0;

        }




        if (!$promotion->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar al usuario'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);


    }

    public function updatePost(UpdatePromotionRequest $request, $promotionId)
    {
        $promotion = Promotion::find($promotionId);

        $promotion->fill($request->all());

        $promotion->save();

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);
    }

    public function active($promotionId)
    {
        $promotion = Promotion::find($promotionId);
        $promotion->active = !$promotion->active;
        if (!$promotion->save()) {
            return response()->json([
                'success' => false,
                'message' => 'no se puede modificar el estatus en este momento'
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function delete($promotionId)
    {
        $promotion = Promotion::find($promotionId);

        if (!$promotion->delete()) {
            return response()->json([
                'success' => false,
                'message' => 'no se puede modificar el estatus en este momento'
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function show($promotionId)
    {
        $promotion = Promotion::find($promotionId);

        return view('admin.promotion.show',[
            'promotion' => $promotion
        ]);
    }



}


