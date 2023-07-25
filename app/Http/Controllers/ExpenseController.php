<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['total']=Expense::where('user_id',Auth::user()->id)->sum('amount');
        $data['expenses'] = Expense::where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view('expenses.index',$data)->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function filter(Request $request){

        $request->validate([
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
        $start_date = $request->start_date;
        $end_date= $request->end_date;
        $data['expenses']=Expense::where('user_id', Auth::user()->id)->whereDate('date1','>=',$start_date)->whereDate('date1','<=',$end_date)->latest()->paginate(20);
        $data['total']=Expense::where('user_id', Auth::user()->id)->whereDate('date1','>=',$start_date)->whereDate('date1','<=',$end_date)->sum('amount');
        return view('expenses.index',$data)->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
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

        $expenses = new expense();
        $expenses->title = $request->title;
        $expenses->amount = $request->amount;
        $expenses->date1 = $request->date1;
        $expenses->user_id = Auth::user()->id;
        $expenses->save();

        return redirect('/expenses')->with('message','New income added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit',compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'date1'=>'required'
        ]);
        $expense->title = $request->title;
        $expense->amount = $request->amount;
        $expense->date1 = $request->date1;
        $expense->update();
        return redirect('/expenses')->with('message', 'Income details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success',' deleted successfully');
    }
}
