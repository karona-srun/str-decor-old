<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleOrder;
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

        $saleAmountDaily = Sale::whereDate('created_at','=', Carbon::today()->toDateString())->sum('total_price');
        $saleAmountMonthly = Sale::whereMonth('created_at', '=', date('m'))->sum('total_price');

        $products = Product::selectRaw("SUM(store_stock) as count")
                            ->selectRaw('product_category_id')
                            ->groupBy('product_category_id')
                            ->get();
        $dataProducts = [];

        $saleOrderDaily = SaleOrder::createdToday()->count();
        $saleOrderMonthly = SaleOrder::createdThisMonth()->count();

        foreach($products as $row) {
            $dataProducts['label'][] = $row->getProductCategory($row->product_category_id);
            $dataProducts['data'][] = (int)$row->count;
        }
    
        $chart_data = json_encode($dataProducts);

        $current = SaleDetail::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', '=', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->pluck('count', 'month_name');
 
    
        $labels = ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'];//$users->keys();
        $data = $current->values();

        $old = SaleDetail::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', '=', date('Y') - 1)
                    ->groupBy(DB::raw("month_name"))
                    ->pluck('count', 'month_name');
 
        $oldData = $old->values();

        return view('darhboard_sale', compact('saleDaily','saleAmountDaily','saleAmountMonthly','saleMonthly','data','oldData','labels','chart_data','saleOrderDaily','saleOrderMonthly'));
    }
}
