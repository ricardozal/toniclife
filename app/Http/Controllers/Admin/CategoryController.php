<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Request\CategoryRequest;
use App\Http\Request\UpdateCategoryRequest;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');

    }


    public function indexContent(Request $request)
    {
        $category = Category::all();
        $query = $category;
        return response()->json([
            'data' => $query
        ]);



    }

    public function update($categoryId){
        $category = Category::find($categoryId);
        return view('admin.category.upsert',['category' => $category]);
    }

    public function create(){
        return view('admin.category.upsert');
    }

    public function createPost(CategoryRequest $request)
    {
        $category = new Category();
        $category->fill($request->all());


        if (!$category->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar la categoria'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);


    }

    public function updatePost(UpdateCategoryRequest $request, $categoryId)
    {
        $category = Category::find($categoryId);

        $category->fill($request->all());

        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);
    }

    public function active($categoryId)
    {
        $category = Category::find($categoryId);
        $category->active = !$category->active;
        if (!$category->save()) {
            return response()->json([
                'success' => false,
                'message' => 'no se puede modificar el estatus en este momento'
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function delete($categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category->delete()) {
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
