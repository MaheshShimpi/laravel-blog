<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
.col-md-6{
    background:#e2e2e2;
    padding:40px;
}
.row h2{
    color:red;
}
.fa{
    font-size:30px;
    color:red;
    margin:0 10px;
  }
</style>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <h2 class="text-center">Information form</h2>
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </p>
                    @endif
                @endforeach
            </div>
            <form class="form-horizontal" action="{{url('/userdata')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
            <label class="control-label" for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
            <label class="control-label" for="mobile">Mobile:</label>
                <input type="number" class="form-control" id="mobile" placeholder="Enter mobile" name="mobile">
            </div>
            <div class="form-group">
            <label class="control-label" for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
            <label class="control-label" for="book">Book:</label>
            <select class="control-label" name="book" id="book">
                <option value="">Select Book</option>
                <option value="Book1">Book1</option>
                <option value="Book2">Book2</option>
                <option value="Book3">Book3</option>
            </select>
            </div>
            <div class="form-group">
            <label class="control-label" for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Book</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user['name']}}</td>
                <td>{{$user['mobile']}}</td>
                <td>{{$user['email']}}</td>
                <td>{{$user['books']['book']}}</td>
                <td>
                @if(!empty($user['image']))
                    <img src="{{asset('public/img/'.$user['image'])}}" alt="" width="100px" height="100px">
                @else
                    <img src="{{asset('public/img/dummy.jpg')}}" alt="" width="100px" height="100px">
                @endif
                </td>
                <td><a href="{{url('/edit-users/'.base64_encode(convert_uuencode($user['id'])))}}"><i class="fa fa-edit"></i></a><a href="{{url('/delete-users/'.base64_encode(convert_uuencode($user['id'])))}}"><i class="fa fa-trash"></i></a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
<!-- </div> -->

</body>
</html>
