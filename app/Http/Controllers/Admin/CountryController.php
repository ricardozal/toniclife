<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller{
    public function index()
    {
        return view('admin.country.index');
    }

    public function indexContent(Request $request)
    {

        $country = Country::all();
        $query = $country;
        return response()->json([
            'data' => $query
        ]);

    }

    public function update($countryId){
        $country = Country::find($countryId);
        return view('admin.country.upsert',['country' => $country]);
    }

    public function create()
    {
        return view('admin.country.upsert');
    }

    public function createPost(CountryRequest $request){
        $country = new Country();
        $country->fill($request->all());

        if (!$country->save()) {
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

    public function updatePost(CountryRequest $request, $countryId)
    {
        $country = Country::find($countryId);
        $country->fill($request->all());

        if (!$country->save()) {
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

    public function active($countryId)
    {
        $country = Country::find($countryId);
        $country->active = !$country->active;
        if (!$country->save()) {
            return response()->json([
                'success' => false,
                'message' => 'no se puede modificar el estatus en este momento'
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
}
