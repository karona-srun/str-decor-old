<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helpers;
use App\Imports\ProductCategoryImport;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
        $product_category = ProductCategory::orderBy('id', 'desc')->get();
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
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
        ], [
            'code.required' => __('app.code') . __('app.product_category') . __('app.required'),
            'name.required' => __('app.label_name') . __('app.product_category') . __('app.required'),
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $productCategory = new ProductCategory();
        $productCategory->code = $request->code;
        $productCategory->name = $request->name;
        $productCategory->note = $request->note;
        $productCategory->created_by = Auth::user()->id;
        $productCategory->updated_by = Auth::user()->id;
        $productCategory->save();

        return redirect('/product-category')->with('success', __('app.product_category') . __('app.label_created_successfully'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => __('app.label_name') . __('app.product_category') . __('app.required'),
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $productCategory = ProductCategory::find($id);
        $productCategory->code = $request->code;
        $productCategory->name = $request->name;
        $productCategory->note = $request->note;
        $productCategory->updated_by = Auth::user()->id;
        $productCategory->save();

        return redirect('/product-category')->with('success', __('app.product_category') . __('app.label_updated_successfully'));
    }

    public function importExcelForm()
    {
        return view('backend.product_category.form');
    }

    public function importExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ], [
            'file.required' => __('app.choose_file') . __('app.product_category'),
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        try {
            Excel::import(new ProductCategoryImport, $request->file('file'));
            $name = date('Y_m_d_hisA') . '_' . $request->file('file')->getClientOriginalName();
            Storage::putFileAs('public/importfiles', $request->file('file'), $name);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
            print_r($failures);
        }

        return back()->with('status', 'ការនាំចូលប្រភេទផលិតរបស់លោកអ្នកបានដោយជោគជ័យ');
    }

    public function exportExcel()
    {
        $file_name = 'Product_Category_' . date('d_m_y_H_i_s') . '.xlsx';

        $datas = ProductCategory::all();

        $productCategory = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'name' => $data->name,
                'note' => $data->note
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.label_name'),
            __('app.label_note')
        ];

        return Helpers::exportExcel($productCategory, $heading, $file_name);

        // return Excel::download(new ExportFiles($productCategory,$heading,$file_name),$file_name);
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

        return redirect('/product-category')->with('success', __('app.product_category') . __('app.label_deleted_successfully'));
    }
}
