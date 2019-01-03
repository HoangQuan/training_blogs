<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('login.loginForm');
    }

    public function doLogin(Request $request)
    {
        $input = $request->all();
        $remember = ($request->has('remember')) ? true : false;
        $attempt = Auth::attempt( array('email' => $input['email'], 'password' => $input['password']), $remember);
        if($attempt) {
          return redirect('posts');
        } else {
            // $request->session()->flash('message', 'Your username/password combination was incorrect.');
            return redirect('login')->with('message', 'Your email/password combination was incorrect.');
        }
    }

    public function logout(Request $request){
        Auth::logout(); // log the user out of our application
        $request->session()->flash('message', 'You are logged out!!!');
        return redirect('login');
    }
}
