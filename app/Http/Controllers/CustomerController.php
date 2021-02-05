<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $customers = DB::table('customers')
                    ->where('customers.deleted_at', Null)
                    ->paginate(5);

        $data = [
            'customers' => $customers,
            'page_title' => 'customers',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'customers' ]
        ];

        return view('customer.index', [
            'data' => $data
        ]);
    }

    public function add_form()
    {

        $data = [
            'page_title' => 'Customer Add',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'Customer Add' ]
        ];
        return view('customer.add', ['data' => $data]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:500',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $imageName = time().'.'.$request->image->extension();

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => "upload/".$imageName
        ]);

        $request->image->move(public_path('upload'), $imageName);

        return redirect()->route('customers')
            ->with('success','You have successfully add customer.');
    }

    public function edit_form(Customer $customer)
    {
        $customer = Customer::withoutTrashed()->where('id', $customer->id)->first();

        $data = [
            'customer' => $customer,
            'page_title' => 'customer Edit',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'customer Edit' ]
        ];
        return view('customer.edit', ['data' => $data]);
    }

    public function edit(Request $request)
    {
        // valdiation
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:500'
        ]);

        if(!empty($request->image)){
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('upload'), $imageName);

            DB::table('customers')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => "upload/".$imageName
            ]);
        }else {
            DB::table('customers')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
        }

        // redirect back
        return redirect()->route('customers')
                ->with('success', 'Updated Succesfully');
    }

    public function destroy(Customer $customer)
    {
        $customer = Customer::where('id', $customer->id)->first();
        if($customer->count())
        {
            $customer->delete();
        }
        else 
        {
            return back()
                ->with('Error', 'Error : customer Dosn`t Exist!');
        }

        return back()
                ->with('success', 'Deleted Succesfully');
    }

}
