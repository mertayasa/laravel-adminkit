<?php

namespace App\Http\Controllers;

use App\DataTables\ProductCategoryDataTable;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{

    const CATEGORIES_FOLDER = 'categories';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductCategoryDataTable $productCategoryDataTable)
    {
        return $productCategoryDataTable->render('product-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort(404);
        return view('product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
    {
        try{
            $data = $request->validated();

            $image = uploadFileHttp($data['image'], self::CATEGORIES_FOLDER);
        
            if($image != false){
                $data['image'] = $image;
            }else{
                throw 'Failed to upload menu category image';
            }

            ProductCategory::create($data);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', trans('flash.failed.store'));
        }

        return redirect()->route('product-category.index')->with('success', trans('flash.success.store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $product_category
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $product_category)
    {
        $data = [
            'product_category' => $product_category
        ];

        return view('product-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $product_category
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, ProductCategory $product_category)
    {
        try{
            $data = $request->validated();

            if(isset($data['image'])){
                $image = uploadFileHttp($data['image'], self::CATEGORIES_FOLDER);
                
                if($image != false){
                    $data['image'] = $image;
                }else{
                    throw 'Failed to upload menu category image';
                }
            }

            $product_category->update($data);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', trans('flash.failed.update'));
        }

        return redirect()->route('product-category.index')->with('success', trans('flash.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $product_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $product_category)
    {
        try{
            if(File::exists(public_path($product_category->image))){ 
                File::delete(public_path($product_category->image));
            };

            $product_category->delete();
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
