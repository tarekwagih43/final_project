<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        $data = [
            'page_title' => 'Login',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'products' ]
        ];
        return view('auth.login', ['data' => $data]);
    }

    public function login(Request $request)
    {
        // valdiation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid Login Details!');
        }

        return redirect()->route('/');

    }
}
