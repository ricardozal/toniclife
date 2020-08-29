<?php


namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Request\UserRequest;
use App\Http\Request\UpdateUserRequest;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function indexContent(Request $request)
    {

        $query = User::with(['role'])->get();

        return response()->json([
            'data' => $query
        ]);

    }

    public function update($userId){
        $user = User::find($userId);
        return view('admin.user.upsert',['user' => $user]);
    }

    public function create(){
        return view('admin.user.upsert');
    }

    public function createPost(UserRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));

        if($request->input('fk_id_branch') != null)
        {
            if($request->input('fk_id_branch') == '0'){

                return response()->json([
                    'errors' => ['fk_id_branch' => ['Debe elegir una sucursal'] ]
                ],422);

            } else {
                $user->fk_id_branch = $request->input('fk_id_branch');
            }
        }

        if (!$user->save()) {
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

    public function updatePost(UpdateUserRequest $request, $userId)
    {
        $user = User::find($userId);

        $user->fill($request->all());

        if($request->input('password') != null)
        {
            $user->password = bcrypt($request->input('password'));
        }

        if($request->input('fk_id_branch') != null)
        {
            $user->fk_id_branch = $request->input('fk_id_branch');
        }

        if (!$user->save()) {
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

    public function active($userId)
    {
        $user = User::find($userId);
        $user->active = !$user->active;
        if (!$user->save()) {
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
