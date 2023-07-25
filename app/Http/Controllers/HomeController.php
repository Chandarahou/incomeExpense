<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $income = Income::where('user_id',Auth::user()->id)->sum('amount');
        $expense = Expense::where('user_id',Auth::user()->id)->sum('amount');
        $data['incomes']=Income::where('user_id',Auth::user()->id)->sum('amount');
        $data['expenses']=Expense::where('user_id',Auth::user()->id)->sum('amount');
        $data['total'] = $income-$expense;
        return view('dashboard',$data);
    }
}
