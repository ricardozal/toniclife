<?php

namespace App\Http\Controllers\Admin;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Http\Request\BranchRequest;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{

    public function index()
    {
        return view('admin.branch.index');
    }

    public function indexContent(Request $request)
    {

        $query = Branch::with(['address'])->get();
        return response()->json([
            'data' => $query
        ]);

    }

    public function update($branchId){
        $branch = Branch::find($branchId);
        return view('admin.branch.upsert',['branch' => $branch]);
    }

    public function create()
    {
        return view('admin.branch.upsert');
    }

    public function createPost(BranchRequest $request)
    {

        $branch = new Branch();
        $address = new Address();

        try{
            \DB::beginTransaction();

            $address->fill($request->all());
            $address->saveOrFail();

            $branch->fill($request->all());
            $branch->fk_id_address = $address->id;
            $branch->saveOrFail();

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Proceso completado'
            ]);
        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'error' => $e
            ]);
        }
    }

    public function updatePost(BranchRequest $request, $branchID)
    {
        $branch = Branch::find($branchID);
        $address = Address::find($branch->fk_id_address);

        try{
            \DB::beginTransaction();
            $branch->fill($request->all());
            $branch->saveOrFail();

            $address->fill($request->all());
            $address->saveOrFail();

            \DB::commit();
            return response()->json([
                'success' => true,
                'branch' => $branch,
                'address' => $address,
                'message' => 'Proceso completado'
            ]);
        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'error' => $e
            ]);
        }
    }

    public function active($branchId)
    {
        $branch = Branch::find($branchId);
        $branch->active = !$branch->active;
        if (!$branch->save()) {
            return response()->json([
                'success' => false,
                'message' => 'no se puede modificar el estatus en este momento'
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function delete($branchId)
    {
        $branch = Branch::find($branchId);

        if (!$branch->delete()) {
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
