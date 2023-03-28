<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Attachment;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $productes = Product::limit(15)->get();
        $producteRandom = Product::inRandomOrder()->limit(10)->get();
        $productCategory = ProductCategory::get();
        return view('frontend.index', compact('productes','producteRandom','productCategory'));
    }

    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        $productes = Product::inRandomOrder()->limit(10)->get();
        $productCategory = ProductCategory::get();
        $attachments = Attachment::where(['type_id'=>$id,'type'=>'product'])->get();
        return view('frontend.details', compact('product','productes','attachments','productCategory'));
    }

    public function getProductByCategory($id)
    {
        $productes = Product::where('product_category_id',$id)->get();
        $productCategory = ProductCategory::get();
        $producteRandom = Product::inRandomOrder()->limit(10)->get();
        return view('frontend.index', compact('productes','producteRandom','productCategory'));
    }

    public function productList()
    {
        $productes = Product::get();
        $productCategory = ProductCategory::get();
        return view('frontend.product_list', compact('productes','productCategory'));
    }

    public function search(Request $request)
    {
        $productes = Product::where('product_code',$request->q)
        ->orWhere('product_name','LIKE', '%'. $request->q.'%')
        ->orWhere('scale',$request->q)
        ->get();
        $productCategory = ProductCategory::get();

        $producteRandom = Product::inRandomOrder()->limit(10)->get();
        return view('frontend.index', compact('productes','producteRandom','productCategory'));
    }

    public function aboutUs()
    {
        $abouts = About::get();
        return view('frontend.about', compact('abouts'));
    }

    public function contactUs()
    {
        return view('frontend.contact');
    }
}
