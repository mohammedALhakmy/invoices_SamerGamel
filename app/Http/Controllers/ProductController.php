<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $any = LaravelLocalization::getCurrentLocale();
        //
        $section = section::all('id','section_name_'.$any. ' as section_name');
        $products = Product::all('id',
                                    'product_name_'.$any.' as product_name',
                                    'product_description_'.$any.' as product_description',
                                    'section_id');
        return view('products.index',compact('products','section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'product_name_ar' => 'required|unique:products|max:999',
            'product_name_en' => 'required|unique:products|max:999',
            'product_description_en' => 'required',
            'product_description_ar' => 'required',
            'section_id' => 'required',
        ],[
            'product_name_ar.required' => __('messages.required ar'),
            'product_name_en.required' => __('messages.required en'),
            'product_description_en.required' => __('messages.description_en en'),
            'product_description_ar.required' => __('messages.description_ar ar'),
            'section_id.required' => __('messages.section_id ar'),

        ]);
        $product = Product::create([
            'product_name_ar' => $request->product_name_ar,
            'product_name_en' => $request->product_name_en,
            'product_description_en' => $request->product_description_en,
            'product_description_ar' => $request->product_description_ar,
            'section_id' =>  $request->section_id,
        ]);
        if ($product){
            return  response()->json([
                'status' => true,
                'msg' => 'تم الخفظ'
            ]);
        }else{
            return  response()->json([
                'status' => false,
                'msg' => 'Error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        return $request;
        $any = LaravelLocalization::getCurrentLocale();
        $id = section::where('section_name_'.$any,$request->section_name_.$any)->first()->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $product = Product::find($request->id);
        if (!$product)
            return redirect()->back();
        $product->delete();
        return response()->json([
            'status' => true,
            'msg' => 'SuccessFully Deleted',
            'id' =>$product->id
        ]);
    }
}
