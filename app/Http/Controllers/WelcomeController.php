<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $productes = Product::get();
        $productCategory = ProductCategory::get();
        return view('frontend.index', compact('productes','productCategory'));
    }

    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        $productes = Product::get();
        $productCategory = ProductCategory::get();
        $attachments = Attachment::where(['type_id'=>$id,'type'=>'product'])->get();
        return view('frontend.details', compact('product','productes','attachments','productCategory'));
    }

    public function search(Request $request)
    {
        $productes = Product::where('product_code',$request->q)
        ->orWhere('product_name','LIKE', '%'. $request->q.'%')
        ->orWhere('scale',$request->q)
        ->get();
        $productCategory = ProductCategory::get();
        return view('frontend.index', compact('productes','productCategory'));
    }
}
