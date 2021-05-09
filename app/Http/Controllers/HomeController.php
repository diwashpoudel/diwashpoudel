<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        protected $user = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route(auth()->user()->role);
        //return view('home');
    }

    public function admin(){
        $counter= array(
                    'products'=>0,
                    'customers'=>$this->user->where('role','customer')->count(),
                    'reviews'=>0,
                    'collections'=>0
        );
        return view('admin.dashboard')->with('counters' ,$counter);
    }
    public function seller()
    {
        return view('seller.dashboard');
    }
    
    public function customer()
    {
        return view('customer.dashboard');
    }

}
