<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $users = User::withoutTrashed()->paginate(5);
        $data = [
            'users' => $users,
            'page_title' => 'users',
            'back_link' => '/',
            'links' => ['home', 'Users' ]
        ];
        
        return view('user.index', [
            'data' => $data
            ]);
    }

    public function add_form()
    {
        $data = [
            'page_title' => 'User Add',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'User Add' ]
        ];
        return view('user.add', ['data' => $data]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:500',
            'email' => 'required|max:255',
            'password' => 'required|confirmed',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $imageName = time().'.'.$request->image->extension();

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => "upload/".$imageName
        ]);

        $request->image->move(public_path('upload'), $imageName);


        return redirect()->route('users')
            ->with('success','You have successfully add Product.');
    }

    public function edit_form(User $user)
    {
        $user = User::where('id', $user->id)->first();

        $data = [
            'user' => $user,
            'page_title' => 'User Edit',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'User Edit' ]
        ];
        return view('user.edit', ['data' => $data]);
    }

    public function edit(Request $request)
    {
        // valdiation
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:500',
            'email' => 'required|max:255'
        ]);

        if(!empty($request->image)){
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('upload'), $imageName);
            if(!empty($request->password)){
                DB::table('users')->where('id', $request->id)->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'image' => "upload/".$imageName
                ]);
            }else{
                DB::table('users')->where('id', $request->id)->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'image' => "upload/".$imageName
                ]);
            }

        }else {
            if(!empty($request->password)){
                DB::table('users')->where('id', $request->id)->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
            }else{
                DB::table('users')->where('id', $request->id)->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email
                ]);
            }
        }

        // redirect back
        return redirect()->route('users')
                ->with('success', 'Updated Succesfully');
    }

    public function destroy(User $user)
    {
        $user = User::where('id', $user->id)->first();
        if($user->count())
        {
            $user->delete();
        }
        else 
        {
            return back()
                ->with('Error', 'Error : Product Dosn`t Exist!');
        }

        return back()
                ->with('success', 'Deleted Succesfully');
    }

}
