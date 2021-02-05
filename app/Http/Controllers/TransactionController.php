<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrdersProducts;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $transactions = DB::table('transactions')
                    ->join('orders', 'orders.id', '=', 'transactions.order_id')
                    ->join('customers', 'orders.customer_id', '=', 'customers.id')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->select('orders.*', 'transactions.*', 'customers.name as customer_name', 'users.name as user_name')
                    ->where('orders.deleted_at', Null)
                    ->where('transactions.deleted_at', Null)
                    ->paginate(10);

        $data = [
            'transactions' => $transactions,
            'page_title' => 'Transactions',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'Transactions' ]
        ];

        return view('transactions.index', [
            'data' => $data
        ]);
    }

    public function pay(Request $request)
    {

        $total_cost = OrdersProducts::withoutTrashed()
            ->where('orders_products.order_id', $request->order_id)
            ->sum('total_sup_price');

        $total_paied = Transaction::withoutTrashed()
            ->where('transactions.order_id', $request->order_id)
            ->sum('paied');

        $remain = $total_cost-$total_paied;

        if($request->payment_note) {
            $note = $request->payment_note;
        }else {
            $note = '';
        }

        if($request->payment_amount <= $remain) {
            Transaction::create([
                'order_id' => $request->order_id,
                'user_id' => auth()->user()->id,
                'paied' => $request->payment_amount,
                'remain' => $total_cost-$total_paied,
                'notes' => $note
            ]);
        }

        $total_paied = Transaction::withoutTrashed()
            ->where('transactions.order_id', $request->order_id)
            ->sum('paied');

        $remain = $total_cost-$total_paied;

        return response()->json([
            'remain' => $remain,
            'total_paied' => $total_paied,
            'total_cost' => $total_cost
        ]);
    }

    public function destroy(Request $request)
    {
        $order = Transaction::where('id', $request->id)->first();
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
}
