<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $data['total']=Income::where('user_id',Auth::user()->id)->sum('amount');
        $data['incomes'] = Income::where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view('incomes.index',$data)->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function filter(Request $request){

        $request->validate([
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
        $start_date = $request->start_date;
        $end_date= $request->end_date;
        $data['incomes']=Income::where('user_id', Auth::user()->id)->whereDate('date1','>=',$start_date)->whereDate('date1','<=',$end_date)->latest()->paginate(20);
        $data['total']=Income::where('user_id', Auth::user()->id)->whereDate('date1','>=',$start_date)->whereDate('date1','<=',$end_date)->sum('amount');
        return view('incomes.index',$data)->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incomes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'date1'=>'required'
        ]);

        $incomes = new Income();
        $incomes->title = $request->title;
        $incomes->amount = $request->amount;
        $incomes->date1 = $request->date1;
        $incomes->user_id = Auth::user()->id;
        $incomes->save();

        return redirect('/incomes')->with('message','New income added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        return view('incomes.edit',compact('income'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
      
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'date1'=>'required'
        ]);


        $income->title = $request->title;
        $income->amount = $request->amount;
        $income->date1 = $request->date1;
        $income->update();
        return redirect('/incomes')->with('message', 'Income details updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes.index')
        ->with('success',' deleted successfully');
    }
}
