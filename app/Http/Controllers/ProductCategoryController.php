<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_category = ProductCategory::orderBy('id','desc')->get();
        return view('backend.product_category.index', compact('product_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'code' =>'required',
            'name' =>'required',
        ],[
            'code.required' => __('app.code').__('app.product_category').__('app.required'),
            'name.required' => __('app.label_name').__('app.product_category').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $productCategory = new ProductCategory();
        $productCategory->code = $request->code;
        $productCategory->name = $request->name;
        $productCategory->note = $request->note;
        $productCategory->created_by = Auth::user()->id;
        $productCategory->updated_by = Auth::user()->id;
        $productCategory->save();

        return redirect('/product-category')->with('status', 'Product Category has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_category = ProductCategory::find($id);
        return view('backend.product_category.show', compact('product_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_category = ProductCategory::find($id);
        return view('backend.product_category.edit', compact('product_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required',
        ],[
            'name.required' => __('app.label_name').__('app.product_category').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $productCategory = ProductCategory::find($id);
        $productCategory->code = $request->code;
        $productCategory->name = $request->name;
        $productCategory->note = $request->note;
        $productCategory->updated_by = Auth::user()->id;
        $productCategory->save();

        return redirect('/product-category')->with('status', 'Product Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productCategory = ProductCategory::find($id);
        $productCategory->delete();

        return redirect('/product-category')->with('status', 'Product Category has been deleted!');
    }
}
