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
use App\Models\StaffInfo;
use App\Models\Time;
use App\Models\User;
use App\Models\Workplace;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        $data = [
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

        return view('home', compact('data'));
    }
}
