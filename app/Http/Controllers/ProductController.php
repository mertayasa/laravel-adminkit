<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    const PRODUCTS_FOLDER = 'products';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_categories = ProductCategory::pluck('name', 'id');
        $data = [
            'product_categories' => $product_categories,
        ];

        return view('product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $data = $request->validated();
            
            $image = uploadFileHttp($data['image'], self::PRODUCTS_FOLDER);
        
            if($image != false){
                $data['image'] = $image;
            }else{
                throw 'Failed to upload menu category image';
            }

            Product::create($data);
        }catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', trans('flash.failed.store'));
        }

        return redirect()->route('product.index')->with('success', trans('flash.success.store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product_categories = ProductCategory::pluck('name', 'id');
        $data = [
            'product' => $product,
            'product_categories' => $product_categories,
        ];

        return view('product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();
            
            if(isset($data['image'])){
                $image = uploadFileHttp($data['image'], self::PRODUCTS_FOLDER);
                
                if($image != false){
                    $data['image'] = $image;
                }else{
                    throw 'Failed to upload menu category image';
                }
            }

            $product->update($data);
        }catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', trans('flash.failed.update'));
        }

        return redirect()->route('product.index')->with('success', trans('flash.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{
            if(File::exists(public_path($product->image))){ 
                File::delete(public_path($product->image));
            };

            $product->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response([
                'message' => trans('flash.failed.delete')
            ], 500);
        }

        return response([
            'message' => trans('flash.success.delete')
        ], 200);
    }
}
