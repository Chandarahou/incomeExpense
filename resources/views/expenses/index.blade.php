@extends('layouts.app')
@section('content')
<div class="row ">
    <div class="col-xl-6 col-md-6 mb-4 ">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Expense</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{$total}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    @endif
<div class="row">
    <div class="col-md-6 mb-4">
        <a href="{{route('expenses.create') }}" class="btn btn-danger">Add New</a>
    </div>
    <div class="col-md-6 mb-4">
        <form action="{{route('expenses.filter')}}" method="GET" class="form-gorup">     
        <input type="date" name="start_date">
        <input type="date" name="end_date">
        <button type="submit" class="btn-sm btn-info">Filter</button>

    </form>
    </div>
</div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success"><p>{{ $message }}</p></div>
        @endif
        <table class="table table-bordered">
            <tr class="table-primary">
                <th>No</th>
                <th>Title</th>
                <th>Amount</th>
                <th>Date</th>
                <th width="280px">Action</th>
            </tr>
        @foreach ($expenses as $expense)        
            <tr>
                    <td>{{++$i}}</td>
                    <td>{{ $expense->title }}</td>
                    <td>${{ $expense->amount }}</td>
                    <td>{{ $expense->date1 }}</td>
                <td>
                    <form action="{{ route('expenses.destroy',$expense->id)}}" method="POST" class="delete-class">
                        <a href="{{ route('expenses.edit',$expense->id)}}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-delete-left"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
{!! $expenses->links() !!}
@endsection