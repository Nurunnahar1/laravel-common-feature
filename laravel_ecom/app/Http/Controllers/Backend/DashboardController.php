<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    function dashboard(){

        $toal_earning =  Order::sum('total');
        $total_order_count = Order::count();
        $total_categories = Category::count();
        $total_products = Product::count();
        $total_customers = User::where('role_id', 2)->count();
        $orders = Order::with(['billing','orderdetails'])->latest('id')->paginate(15);

        $order_on_2021 = Order::whereBetween('created_at',['2021-01-01', '2021-12-31'])->count();
        $order_on_2022 = Order::whereBetween('created_at',['2022-01-01', '2022-12-31'])->count();
        $order_on_2023 = Order::whereBetween('created_at',['2023-01-01', '2023-12-31'])->count();

        $order_year_wise = [$order_on_2021, $order_on_2022, $order_on_2023];

        return view('backend.pages.dashboard', compact('toal_earning', 'total_order_count', 'total_categories','total_products','total_customers','orders','order_year_wise'));

    }
}
