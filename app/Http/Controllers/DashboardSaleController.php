<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardSaleController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $saleDaily = Sale::whereDate('created_at','=', Carbon::today()->toDateString())->count();
        $saleMonthly = Sale::whereMonth('created_at', '=', date('m'))->count();

        return view('darhboard_sale', compact('saleDaily','saleMonthly'));
    }
}
