<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
 
        $current = Product::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(buying_date) as month_name"))
                    ->whereYear('buying_date', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->pluck('count', 'month_name');
 
    
        $labels = ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'];//$users->keys();
        $data = $current->values();

        $old = Product::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(buying_date) as month_name"))
                    ->whereYear('buying_date', date('Y')-1)
                    ->groupBy(DB::raw("month_name"))
                    ->pluck('count', 'month_name');
 
        $oldData = $old->values();

        return view('darhboard_sale', compact('saleDaily','saleMonthly','data','oldData','labels'));
    }
}
