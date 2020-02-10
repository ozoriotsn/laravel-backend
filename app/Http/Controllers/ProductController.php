<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public $product;

    public function __construct(product $product)
    {
        $this->product = new product();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Product::with('category')->distinct()->paginate(10), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        if(Product::where('code', '=', $request->code)->exists()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => Lang::get('messages.error.code_exist')
            ], 422);
        }

        $messages = [
            'description' =>  Lang::get('messages.error.description'),
            'value' => Lang::get('messages.error.value'),
            'code' => Lang::get('messages.error.code')
        ];
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'value' => 'required|unique:products',
            'code' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $messages,
            ], 422);
        } else {

            $priceArray = [',','.'];
            $price  = substr(str_replace($priceArray,'',$request->value),0,-2);
            $this->product->description = $request->description;
            $this->product->value = $price;
            $this->product->code = $request->code;
            $this->product->save();

            // insert in product_categories
            foreach ($request->category as $category){
                DB::table('product_categories')->insert([
                    'product_id'  => $this->product->id,
                    'category_id' => $category['id']
                ]);
            }
            return response()->json($this->product, 200);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Product::with('category')->findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, product $product, $id)
    {

        $product = $this->product::findOrFail($id);
        $priceArray = [',','.'];
        $price  = substr(str_replace($priceArray,'',$request->value),0,-2);
        $productData = [
            'description' =>  $request->description,
            'value' =>   $price,
            'code' => $request->code
        ];

        //dd($price);
        $product->update($productData);

        // delete in product_categories
        foreach ($request->category as $category){
            DB::table('product_categories')->where([
                'product_id'  => $id
            ])->delete();
        }

        // insert in product_categories
        foreach ($request->category as $category){
            DB::table('product_categories')->insert([
                'product_id'  => $id,
                'category_id' => $category['id']
            ]);
        }

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(product $product, $id)
    {
        $product = product::findOrFail($id);
        $product->delete();

        return response()->json($product, 200);
    }
}
