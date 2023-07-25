@extends('layouts.app')

@section('content')
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
            <a href="{{route('incomes.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <form action="{{route('incomes.store') }}" method="POST" class="form-group">
        @csrf
        <label for="title">Title:</label>
        <input type="text"id="title" name="title" class="form-control">
        <label for="amount">amount:</label>
        <input type="text"id="amount" name="amount"placeholder="0$" class="form-control">
        <label for="date" >Date:</label>
        <input type="date"id="date" name="date1" class="form-control">
        <br>
        <button type="submit" class="btn-lg btn-success">Save</button>
    </form>
@endsection 