<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $productes = Product::get();
        $productCategory = ProductCategory::get();
        return view('welcome', compact('productes','productCategory'));
    }

    public function search(Request $request)
    {
        $productes = Product::where('product_code',$request->q)
        ->orWhere('product_name','LIKE', '%'. $request->q.'%')
        ->orWhere('scale',$request->q)
        ->get();
        $productCategory = ProductCategory::get();
        return view('welcome', compact('productes','productCategory'));
    }
}
