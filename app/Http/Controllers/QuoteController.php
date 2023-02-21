<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::orderBy('created_at', 'desc')->get();
        return view('backend.quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::orderBy('customer_name','desc')->get();
        $products = Product::orderBy('product_name','desc')->get(['id','product_name']);
        return view('backend.quotes.create', compact('products','customers'));
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
            'customer' =>'required',
            'date' =>'required',
        ],[
            'customer.required' => __('app.customer').__('app.required'),
            'date.required' => __('app.table_date').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $quote_no = $this->getNextQuoteNo();
        $quote = new Quote();
        $quote->quote_no = $quote_no;
        $quote->customer_id = $request->customer;
        $quote->date = $request->date;
        $quote->total_amount = array_sum($request->total_amount); //collect($request->total_amount)->sum();
        $quote->contract = $request->contract;
        $quote->created_by = Auth::user()->id;
        $quote->updated_by = Auth::user()->id;
        $quote->save();

        foreach($request->code as $index => $item)
        {
            $quoteDetail = new QuoteDetail();
            $quoteDetail->quotes_id = $quote->id;
            $quoteDetail->product_id = $request['product'][$index];
            $quoteDetail->qty = $request['qty'][$index];
            $quoteDetail->amount = $request['amount'][$index];
            $quoteDetail->unit = $request['unit'][$index];
            $quoteDetail->total_amount = $request['total_amount'][$index];
            $quoteDetail->save();
        } 

        return redirect('/quotes')->with('success', __('app.quote').__('app.label_created_successfully'));
    }

    public function getNextQuoteNo()
    {
        // Get the last created order
        $lastOrder = Quote::orderBy('created_at', 'desc')->first();

        if ( ! $lastOrder )
            $number = 0;
        else
            $number = substr($lastOrder->quote_no, 3);

        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.

        return '#QU' . sprintf('%06d', intval($number) + 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quote = Quote::find($id);
        return view('backend.quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {
        $customers = Customer::orderBy('customer_name','desc')->get();
        $products = Product::orderBy('product_name','desc')->get(['id','product_name']);
        $quote = Quote::find($quote->id);
        return view('backend.quotes.edit', compact('products','customers','quote'));
    }

    public function print($id)
    {
        $quote = Quote::find($id);
        $customers = Customer::orderBy('customer_name','desc')->get();
        $products = Product::orderBy('product_name','desc')->get(['id','product_name']);
        $quote = Quote::find($id);
        return view('backend.quotes.print', compact('products','customers','quote'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);
        $quote->customer_id = $request->customer;
        $quote->date = $request->date;
        $quote->total_amount = array_sum($request->total_amount); //collect($request->total_amount)->sum();
        $quote->contract = $request->contract;
        $quote->updated_by = Auth::user()->id;
        $quote->save();

        QuoteDetail::where('quotes_id',[$quote->id])->delete();

        foreach($request->code as $index => $item)
        {
            $quoteDetail = new QuoteDetail();
            $quoteDetail->quotes_id = $quote->id;
            $quoteDetail->product_id = $request['product'][$index];
            $quoteDetail->qty = $request['qty'][$index];
            $quoteDetail->amount = $request['amount'][$index];
            $quoteDetail->unit = $request['unit'][$index];
            $quoteDetail->total_amount = $request['total_amount'][$index];
            $quoteDetail->save();
        } 

        return redirect('/quotes')->with('success', __('app.quote').__('app.label_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
