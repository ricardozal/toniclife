<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Request\DistributorRequest;
use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        return view('admin.distributor.index');
    }

    public function indexContent(Request $request)
    {

        $query = Distributor::with(['distributor'])->get();

        return response()->json([
            'data' => $query
        ]);

    }

    public function update($distributorId){
        $distributor = Distributor::find($distributorId);
        return view('admin.distributor.upsert',['distributor' => $distributor]);
    }

    public function create(){
        return view('admin.distributor.upsert');
    }

    public function createPost(DistributorRequest $request)
    {
        $distributor = new Distributor();
        $distributor->fill($request->all());
        $distributor->password = bcrypt($request->input('password'));
        $distributor->accumulated_points = 0;

        if($request->input('fk_id_distributor') != null)
        {
            $distributor->fk_id_distributor = $request->input('fk_id_distributor');
        }

        if (!$distributor->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar al distribuidor'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);


    }

    public function updatePost(DistributorRequest $request, $distributorId)
    {
        $distributor = Distributor::find($distributorId);

        $distributor->fill($request->all());
        $distributor->accumulated_points = $request->input('accumulated_points');

        if($request->input('password') != null)
        {
            $distributor->password = bcrypt($request->input('password'));
        }

        if($request->input('fk_id_distributor') != null)
        {
            $distributor->fk_id_distributor = $request->input('fk_id_distributor');
        }


        if (!$distributor->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar al distribuidor'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);
    }

    public function active($distributorId)
    {
        $distributor = Distributor::find($distributorId);
        $distributor->active = !$distributor->active;
        if (!$distributor->save()) {
            return response()->json([
                'success' => false,
                'message' => 'no se puede modificar el estatus en este momento'
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function delete($distributorId)
    {
//        $user = User::find($userId);
//
//        if (!$user->delete()) {
//            return response()->json([
//                'success' => false,
//                'message' => 'no se puede modificar el estatus en este momento'
//            ]);
//        }
//        return response()->json([
//            'success' => true,
//        ]);
    }
}
