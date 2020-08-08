<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Request\OfficeParcelRequest;
use App\Models\OfficeParcel;
use Illuminate\Http\Request;

class OfficeParcelController extends Controller
{
    public function index()
    {
        return view('admin.office_parcel.index');
    }

    public function indexContent(Request $request)
    {

        $query = OfficeParcel::all();

        return response()->json([
            'data' => $query
        ]);

    }

    public function update($officeParcelId){
        $officeParcel = OfficeParcel::find($officeParcelId);
        return view('admin.office_parcel.upsert',['officeParcel' => $officeParcel]);
    }

    public function create(){
        return view('admin.office_parcel.upsert');
    }

    public function createPost(OfficeParcelRequest $request)
    {
        $officeParcel = new OfficeParcel();
        $officeParcel->fill($request->all());

        if (!$officeParcel->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);


    }

    public function updatePost(OfficeParcelRequest $request, $officeParcelId)
    {
        $officeParcel = OfficeParcel::find($officeParcelId);

        $officeParcel->fill($request->all());

        if (!$officeParcel->save()) {
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

    public function active($officeParcelId)
    {
        $officeParcel = OfficeParcel::find($officeParcelId);
        $officeParcel->active = !$officeParcel->active;
        if (!$officeParcel->save()) {
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
