<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $category;

    public function __construct(Category $category)
    {
        $this->category = new Category();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Category::with('product')->distinct()->paginate(10), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $messages = [
            'description' => Lang::get('messages.error.description')
        ];
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $messages,
            ], 422);
        } else {
            $this->category->description = $request->description;
            $this->category->save();
            return response()->json($this->category, 200);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->category->findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category, $id)
    {
        $category = $this->category::findOrFail($id);
        $category->description = $request->description;
        $category->save();
        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category, $id)
    {
        $product = Category::findOrFail($id);
        $product->delete();
        return response()->json($category, 200);
    }

}
