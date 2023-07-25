<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
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
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <a href="{{route('expenses.index')}}" class="btn btn-info" style="margin-top: 20px">Back.!!</a> <br> <br>
                <form action="{{ route('expenses.update',$expense->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="title"><strong>Choose a Title:</strong></label>
                                <select id="title" name="title" class="form-select">
                                    <option value="{{ $expense->title }}">{{ $expense->title }}</option>
                                  <option value="Transportation">Transportation</option>
                                  <option value="Food">Food</option>
                                  <option value="Internet">Internet</option>
                                  <option value="Entertainment">Entertainment</option>
                                  <option value="Shopping">Shopping</option>
                                  <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Amount:</strong>
                                <input type="text" name="amount" value="{{ $expense->amount }}" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Date:</strong>
                                <input type="date" name="date1" value="{{ $expense->date1 }}" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>