<?php


namespace App\Http\Controllers\Branch;


use App\Http\Controllers\Controller;
use App\Http\Request\InventoryLocalRequest;
use App\Http\Request\InventoryLocalUpdateRequest;
use App\Models\Branch;
use App\Models\Movement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $branch = Branch::find(Auth::user()->branch->id);
        return view('branch.inventory.index',[
            'branch' => $branch
        ]);
    }

    public function indexContent()
    {
        $query = Branch::find(Auth::user()->branch->id)->products()->get();
        return response()->json([
            'data' => $query
        ]);
    }

    public function update(Request $request){
        $productId = $request->input('productId');
        $product = Product::find($productId);
        return view('branch.inventory.update_stock',[
            'product'=>$product
        ]);
    }

    public function updatePost(InventoryLocalUpdateRequest $request)
    {
        $productId = $request->input('productId');
        $stock = $request->input('stock');
        $type = $request->input('type');

        $branchFormId  = Branch::findOrFail(Auth::user()->branch->id);

        $stockBP = $branchFormId->products()->findOrFail($productId,['stock'])->pivot->stock;

        try{
            \DB::beginTransaction();


            if (!$type)
            {
                $totalStock = $stockBP - $stock;
                if($totalStock<1){
                    return response()->json([
                        'errors' => ['stock' => ['El stock no puede ser menor a 1'] ]
                    ],422);
                }else{
                    $branchFormId->products()->updateExistingPivot($productId,['stock'=> $totalStock]);
                }

            }else{
                $totalStock = $stockBP + $stock;
                $branchFormId->products()->updateExistingPivot($productId,['stock'=> $totalStock]);
            }

            $movement = new Movement();
            $movement->comment = 'Reajuste manual de stock de sucursal '.$branchFormId->name;
            $movement->type = $type;
            $movement->quantity = $stock;
            $movement->fk_id_product = $productId;
            $movement->fk_id_user = Auth::user()->id;
            $movement->saveOrFail();

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

    public function create()
    {
        return view('branch.inventory.create');
    }

    public function createPost(InventoryLocalRequest $request)
    {

        $branchFormId  = Branch::findOrFail(Auth::user()->branch->id);
        $stock = $request->input('stock');
        $productId = $request->input('fk_id_product');
        /** @var Product $productNew */
        $productNew = Product::find($productId);

        $products = $branchFormId->products;

        foreach($products as $product)
        {
            if($product->id == $productNew->id)
            {
                return response()->json([
                    'errors' => ['name' => ['El producto ya se encuentra agregado en el inventario'] ]
                ],422);
            }
        }

        $branchFormId->products()->attach($productId,['stock'=>  $stock]);

        $movement = new Movement();
        $movement->comment = 'Se agregó el producto '.$productNew->name.' a la sucursal'.' '.$branchFormId->name;
        $movement->quantity  = $stock;
        $movement->type = 1;
        $movement->fk_id_product  = $productNew->id;
        $movement->fk_id_user = Auth::user()->id;
        $movement->save();

        if (!$branchFormId->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se guardo el producto'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);

    }
}
