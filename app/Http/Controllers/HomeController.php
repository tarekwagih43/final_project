<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $total_products = Product::all()->count();
        $total_users = User::all()->count();
        $total_orders = Order::all()->count();
        $total_customers = Customer::all()->count();

        $products = DB::table('orders_products')
        ->join('products', 'orders_products.product_id', '=', 'products.id')
        ->select('products.*', 'orders_products.*', DB::raw('SUM(orders_products.quantity) as quantity'))
        ->where('orders_products.deleted_at', NULL)
        ->groupBy('orders_products.product_id')
        ->paginate(10);

        $data = [
            'products' => $products,
            'total_products' => $total_products,
            'total_users' => $total_users,
            'total_orders' => $total_orders,
            'total_customers' => $total_customers,
            'page_title' => 'home',
            'back_link' => '/',
            'links' => ['Home', 'Dashboard' ]
        ];

        return view('dashboard', [
            'data' => $data
            ]);
        }
    }
