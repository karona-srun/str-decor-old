<?php

namespace App\Http\Controllers;

use App\Models\AddCart;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AddCartController extends Controller
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
        //
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
        $product = Product::find($request->product_id);

        if($product->store_stock < $request->product_qty) {
            return response()->json(['success' => false, 'message' => 'Update stock is failed!'], 422);
        }

        $update_qty = $product->store_stock - $request->product_qty;
        $product->store_stock = $update_qty;
        $product->save();

        $addCart = new AddCart();
        $addCart->product_id = $product->id;
        $addCart->product_code = $product->product_code;
        $addCart->product_name = $product->product_name;
        $addCart->scale = $product->scale;
        $addCart->qty = $request->product_qty;
        $addCart->price = $request->product_price;
        $addCart->note = $request->note;
        $addCart->created_by = Auth::user()->id;
        $addCart->updated_by = Auth::user()->id;
        $addCart->save();

        return Redirect::back(); //response()->json(['success' => true, 'message' => 'Update stock is success!']);
    }

    public function getAddCartByCreator()
    {
        $addCart = AddCart::where('creator', Auth::user()->id)->get();
        return response()->json($addCart);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddCart  $addCart
     * @return \Illuminate\Http\Response
     */
    public function show(AddCart $addCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddCart  $addCart
     * @return \Illuminate\Http\Response
     */
    public function edit(AddCart $addCart)
    {
        //
    }

    public function print($id)
    {
        // $addCart = AddCart::where('created_by', Auth::user()->id)->get();
        $sale = Sale::find($id);
        return view('backend.sales.print', compact('sale'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddCart  $addCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddCart  $addCart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addCart = AddCart::find($id);

        $product = Product::find($addCart->product_id);
        $update_stock = $addCart->qty + $product->store_stock;
        $product->store_stock = $update_stock;
        $product->save();

        $addCart->delete();

        return Redirect::back();
    }
}
