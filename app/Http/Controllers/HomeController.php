<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Customer;
use App\Models\Expend;
use App\Models\ExpendOptions;
use App\Models\Income;
use App\Models\IncomeOptions;
use App\Models\Position;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\StaffInfo;
use App\Models\Time;
use App\Models\User;
use App\Models\Workplace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
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
        $customer = Customer::count();
        $staff = StaffInfo::count();
        $position = Position::count();
        $workplace = Workplace::count();
        $attendance = Attendance::whereDate('created_at', Carbon::today())->count();
        $sale = Sale::count();
        $productcategory = ProductCategory::count();
        $product = Product::count();
        $income = Income::count();
        $expend = Expend::count();
        $user = User::count();
        $role = Role::count();
        $optionIncome = IncomeOptions::count();
        $optioinExpend = ExpendOptions::count();
        $time = Time::count();

        $datas = [
            'customer' => $customer,
            'staff' => $staff,
            'position' => $position,
            'workplace' => $workplace,
            'attendance' => $attendance,
            'sale' => $sale,
            'productCategory' => $productcategory,
            'product' => $product,
            'income' => $income,
            'expend' => $expend,
            'user' => $user,
            'role' => $role,
            'optionIncome' => $optionIncome,
            'optionExpend' => $optioinExpend,
            'time' => $time
        ];

        $saleDaily = Sale::whereDate('created_at','=', Carbon::today()->toDateString())->count();
        $saleMonthly = Sale::whereMonth('created_at', '=', date('m'))->count();

        $products = Product::selectRaw("SUM(store_stock) as count")
                            ->selectRaw('product_category_id')
                            ->groupBy('product_category_id')
                            ->get();
        $dataProducts = [];

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

        return view('home', compact('datas','saleDaily','saleMonthly','data','oldData','labels','chart_data'));

    }
}
