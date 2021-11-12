<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>


<form action="{{ route('user.login') }}" method="POST">
    <h5>Login</h5>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <label>
        <p class="label-txt">YOUR EMAIL</p>
        <input name="email" type="text" class="input">
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <p class="label-txt">YOUR PASSWORD</p>
        <input name="password" type="password" class="input">
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <div class="d-flex flex-start mb-4">
        <a href="{{ route('user.create.form') }}">Not registered</a>
    </div>
    <button type="submit">Submit</button>
    @csrf
</form>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('assets/app.js') }}"></script>

</body>
</html>
