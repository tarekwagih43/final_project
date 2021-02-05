<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrdersProducts;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $orders = DB::table('orders')
                    ->join('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.name as customer_name', )
                    ->where('orders.deleted_at', Null)
                    ->paginate(5);
        $data = [
            'orders' => $orders,
            'page_title' => 'orders',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'orders' ]
        ];

        return view('order.index', [
            'data' => $data
        ]);
    }

    public function add_form()
    {
        $customers = DB::table('customers')
            ->where('customers.deleted_at', Null)
            ->get();

        $data = [
            'customers' => $customers,
            'page_title' => 'Open Order',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'Open Order' ]
        ];
        return view('order.add', ['data' => $data]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
        ]);
        Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => auth()->user()->id,
            'status' => 0
        ]);

        return redirect()->route('orders')
            ->with('success','You have successfully Opend Order.');
    }

    public function destroy(Order $order)
    {
        $order = Order::where('id', $order->id)->first();
        if($order->count())
        {
            $order->delete();
        }
        else
        {
            return back()
                ->with('Error', 'Error : order Dosnt Exist!');
        }

        return back()
                ->with('success', 'Deleted Succesfully');
    }

    public function view(Order $order)
    {
        $order = Order::withoutTrashed()
                    ->join('customers', 'customers.id', '=', 'orders.customer_id')
                    ->select('orders.*', 'customers.name as customer_name','customers.email as customer_email', 'customers.phone as customer_phone', 'customers.address as customer_address')
                    ->where('orders.id', $order->id)
                    ->first();
        $categories = Category::withoutTrashed()->get();
        $products = OrdersProducts::withoutTrashed()
                    ->join('products', 'products.id', '=', 'orders_products.product_id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.*', 'orders_products.*', 'categories.title as category_title', 'orders_products.id as orders_products_id')
                    ->where('orders_products.order_id', $order->id)
                    ->get();
        $total_cost = OrdersProducts::withoutTrashed()
                    ->where('orders_products.order_id', $order->id)
                    ->sum('total_sup_price');
        $total_paid = Transaction::withoutTrashed()
                    ->where('transactions.order_id', $order->id)
                    ->sum('paied');
        $remain = $total_cost - $total_paid;

        $data = [
            'order' => $order,
            'products' => $products,
            'categories' => $categories,
            'total_cost' => $total_cost,
            'total_paid' => $total_paid,
            'remain' => $remain,
            'page_title' => 'Order ',
            'back_link' => route('orders'),
            'links' => ['Dashboard', 'Order' ]
        ];
        return view('order.order', [
            'data' => $data
        ]);
    }

}
