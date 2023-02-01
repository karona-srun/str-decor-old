<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helpers;
use App\Models\Attachment;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
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
        $products = Product::orderBy('id','desc')->get();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_category = ProductCategory::orderBy('id','desc')->get();
        return view('backend.products.create', compact('product_category'));
    }

    public function getQty($id)
    {
        $product = Product::find($id);
        return view('backend.products.transf', compact('product'));
    }

    public function transfProducteQty(Request $request, $id)
    {
        $product = Product::find($id);

        if($product->warehouse < $request->store_stock){
            return redirect()->back()->with('warning',__('app.label_cannot_store_stock'));
        }

        $product->warehouse  = $product->warehouse - $request->store_stock;
        $product->store_stock = $product->store_stock + $request->store_stock;
        $product->save();

        return redirect('productes')->with('success',__('app.label_store_stock').__('app.label_updated_successfully'));
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
            'product_category' =>'required',
            'code' =>'required',
            'name' => 'required',
            'scale' => 'required',
            'buying_price' => 'required',
            'salling_price' => 'required',
            'buying_date' => 'required',
            'store_stock' => 'required',
            'warehouse' => 'required',
            'photo' => 'required',
        ],[
            'product_category.required' => __('app.product_category').__('app.required'),
            'code.required' => __('app.code').__('app.product_category').__('app.required'),
            'name.required' => __('app.label_name').__('app.product_category').__('app.required'),
            'scale.required' => __('app.label_scale').__('app.required'),
            'buying_price.required' => __('app.label_buying_price').__('app.required'),
            'salling_price.required' => __('app.label_salling_price').__('app.required'),
            'buying_date.required' => __('app.label_buying_date').__('app.required'),
            'store_stock.required' => __('app.label_store_stock').__('app.required'),
            'warehouse.required' => __('app.label_warehouse').__('app.required'),
            'photo.required' => __('app.btn_browser').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $imageName = '';
        if($request->hasFile('photo')){
            $imageName = 'product_'.time().rand(1,99999).'.'.$request->photo->getClientOriginalExtension();
            $imageName = str_replace(' ','_',$imageName);
            $request->photo->move(public_path('products'), $imageName);
        }

        $product = new Product();
        $product->product_category_id = $request->product_category;
        $product->product_code = $request->code;
        $product->product_name = $request->name;
        $product->scale = $request->scale;
        $product->buying_price = $request->buying_price;
        $product->salling_price = $request->salling_price;
        $product->buying_date = $request->buying_date;
        $product->store_stock = $request->store_stock;
        $product->warehouse = $request->warehouse;
        $product->photo = $imageName;
        $product->description = $request->description;
        $product->note = $request->note;
        $product->created_by = Auth::user()->id;
        $product->updated_by = Auth::user()->id;
        $product->save();

        $images = [];
        if ($request->filenames){
            foreach($request->filenames as $key => $image)
            {
                $imageName = 'product_'.time().rand(1,99999).'.'.$image->getClientOriginalExtension();  
                $imageName = str_replace(' ','_',$imageName);
                $image->move(public_path('attachments'), $imageName);
                $attachment = new Attachment();
                $attachment->name = $imageName;
                $attachment->path = $image;
                $attachment->type_id = $product->id;
                $attachment->type = 'product';
                $attachment->save();
            }
        }

        return redirect('/productes')->with('success',__('app.product').__('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $attachments = Attachment::where(['type_id'=>$id,'type'=>'product'])->get(); 
        return view('backend.products.show', compact('product','attachments'));
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $product_category = ProductCategory::orderBy('id','desc')->get();
        $attachments = Attachment::where(['type_id'=>$id,'type'=>'product'])->get(); 
        return view('backend.products.edit', compact('product','product_category','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'code' =>'required',
            'name' => 'required',
            'scale' => 'required',
            'buying_price' => 'required',
            'salling_price' => 'required',
            'buying_date' => 'required',
            'store_stock' => 'required',
            'warehouse' => 'required',
        ],[
            'code.required' => __('app.code').__('app.product_category').__('app.required'),
            'name.required' => __('app.label_name').__('app.product_category').__('app.required'),
            'scale.required' => __('app.label_scale').__('app.required'),
            'buying_price.required' => __('app.label_buying_price').__('app.required'),
            'salling_price.required' => __('app.label_salling_price').__('app.required'),
            'buying_date.required' => __('app.label_buying_date').__('app.required'),
            'store_stock.required' => __('app.label_store_stock').__('app.required'),
            'warehouse.required' => __('app.label_warehouse').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }


      
        $product = Product::find($id);
        $imageName = '';

        if($request->hasFile('photo')){
            File::delete('products/'.$product->photo);
            $imageName = 'product_'.time().rand(1,99999).'.'.$request->photo->getClientOriginalExtension();
            $imageName = str_replace(' ','_',$imageName);
            $request->photo->move(public_path('products'), $imageName);
            $product->photo = $imageName;
        }


        $product->product_category_id = $request->product_category;
        $product->product_code = $request->code;
        $product->product_name = $request->name;
        $product->scale = $request->scale;
        $product->buying_price = $request->buying_price;
        $product->salling_price = $request->salling_price;
        $product->buying_date = $request->buying_date;
        $product->store_stock = $request->store_stock;
        $product->warehouse = $request->warehouse;
        $product->description = $request->description;
        $product->note = $request->note;
        $product->updated_by = Auth::user()->id;
        $product->save();

        $images = [];
        if ($request->filenames){
            foreach($request->filenames as $key => $image)
            {
                File::delete('attachments/'.$product->photo);
                $imageName = 'product_'.time().rand(1,99999).'.'.$image->getClientOriginalExtension();  
                $image->move(public_path('attachments'), $imageName);

                $attachment = new Attachment();
                $attachment->name = $imageName;
                $attachment->path = $image;
                $attachment->type_id = $product->id;
                $attachment->type = 'product';
                $attachment->save();
            }
        }

        return redirect('/productes')->with('success',__('app.product').__('app.label_updated_successfully'));
    }

    public function exportExcel()
    {
        $file_name = 'Productes_'.date('d_m_y_H_i_s').'.xlsx';

        $datas = Product::all();

        $product = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'product_category' => $data->productCategory->name,
                'code' => $data->product_code,
                'name' => $data->product_name,
                'scale' => $data->scale,
                'buying' => '$'.$data->buying_price,
                'salling' => '$'.$data->salling_price,
                'buying_date' => $data->buying_date,
                'store_stock' => $data->store_stock,
                'warehouse' => $data->warehouse,
                'sold_out' => $data->sold_out,
                'description' => $data->description,
                'note' => $data->note
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.product_category'),
            __('app.code'),
            __('app.label_name'),
            __('app.label_scale'),
            __('app.label_buying_price'),
            __('app.label_salling_price'),
            __('app.label_buying_date'),
            __('app.label_store_stock'),
            __('app.label_warehouse'),
            __('app.label_sold_out'),
            __('app.label_description'),
            __('app.label_note')
        ];

        return Helpers::exportExcel($product,$heading,$file_name);
        
        // return Excel::download(new ExportFiles($product,$heading,$file_name),$file_name);
    }

    public function deletePhoto($id)
    {
        $attachment = Attachment::find($id);
        if ($attachment->delete()) {
            File::delete('attachments/'.$attachment->name);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        File::delete('products/'.$product->photo);

        $attachments = Attachment::where(['type_id'=>$id,'type'=>'product'])->get();
        foreach($attachments as $att){
            File::delete('attachments/'.$att->name);
            $attachments->delete();
        }

        $product->delete();

        return redirect('/productes')->with('danger',__('app.product').__('app.label_deleted_successfully'));
    }
}
