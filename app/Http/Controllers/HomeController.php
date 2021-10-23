<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }

    public function users(){
       return view('users.list');
    }

    public function roles(){
        return view('roles.list');
    }

    public function add(){
        return view('roles.add');
    }

    public function save(Request $request){
        dd($request);
    }
}
