<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdersProducts;
use App\Models\Product;
use App\Models\Transaction;

class OrdersProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function delete_product_from_order(Request $request)
    {
        $order_product = OrdersProducts::where('id', $request->order_products_id)->first();
        if($order_product->count())
        {
            $order_product->delete();
        }
        else
        {
            return back()
                ->with('Error', 'Error : order Dosn`t Exist!');
        }

        $total_cost = OrdersProducts::withoutTrashed()
            ->where('orders_products.order_id', $order_product->order_id)
            ->sum('total_sup_price');

        $total_paied = Transaction::withoutTrashed()
            ->where('transactions.order_id', $request->order_id)
            ->sum('paied');

        return response()->json([
            'total_paied' => $total_paied,
            'total_cost' => $total_cost
        ]);
    }

    public function add_products_to_order(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required',
            'product_id' => 'required'
        ]);

        $product = Product::withoutTrashed()->where('products.id', $request->product_id)->first();

        $total = $product->price * $request->quantity;

        OrdersProducts::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_sup_price' => $total,
            'user_id' => auth()->user()->id
        ]);

        $total_cost = OrdersProducts::withoutTrashed()
            ->where('orders_products.order_id', $request->order_id)
            ->sum('total_sup_price');

        $total_paied = Transaction::withoutTrashed()
            ->where('transactions.order_id', $request->order_id)
            ->sum('paied');

        $product = OrdersProducts::withoutTrashed()
                    ->join('products', 'products.id', '=', 'orders_products.product_id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.*', 'orders_products.*', 'categories.title as category_title')
                    ->where('orders_products.order_id', $request->order_id)
                    ->latest('created_at')
                    ->first();

        return response()->json([
            'product' => $product,
            'total_paied' => $total_paied,
            'total_cost' => $total_cost
        ]);
    }

}
