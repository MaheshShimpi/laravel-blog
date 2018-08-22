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
        <h2 class="text-center">Edit User Information</h2>
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </p>
                    @endif
                @endforeach
            </div>
            <form class="form-horizontal" action="{{url('/update-user')}}" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
            <input type="hidden" name='user_id' value="{{$userData['id']}}">
            <label class="control-label" for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$userData['name']}}">
            </div>
            <div class="form-group">
            <label class="control-label" for="mobile">Mobile:</label>
                <input type="number" class="form-control" id="mobile" placeholder="Enter mobile" name="mobile" value="{{$userData['mobile']}}">
            </div>
            <div class="form-group">
            <label class="control-label" for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{$userData['email']}}">
            </div>
            <div class="form-group">
            <label class="control-label" for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                @if(!empty($user['image']))
                    <img src="{{asset('public/img/'.$userData['image'])}}" alt="" width="100px" height="100px">
                @else
                    <img src="{{asset('public/img/dummy.jpg')}}" alt="" width="100px" height="100px">
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

</body>
</html>
