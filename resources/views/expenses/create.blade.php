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
            <a href="{{route('expenses.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <form action="{{route('expenses.store') }}" method="POST" class="form-group">
        @csrf
        <label for="title">Choose a Title:</label>
        <select id="title" name="title" class="form-select">
          <option value="Transportation">Transportation</option>
          <option value="Food">Food</option>
          <option value="Internet">Internet</option>
          <option value="Entertainment">Entertainment</option>
          <option value="Shopping">Shopping</option>
          <option value="Other">Other</option>
        </select>
        <label for="amount">amount:</label>
        <input type="text"id="amount" name="amount"placeholder="0$" class="form-control">
        <label for="date" >Date:</label>
        <input type="date"id="date" name="date1" class="form-control">
        <br>
        <button type="submit" class="btn-lg btn-success">Save</button>
    </form>
@endsection 