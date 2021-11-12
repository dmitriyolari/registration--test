<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>

<div class="d-flex justify-content-around mt-2 mb-5">
    <a href="{{ route('user.create.child.form') }}">Create child</a>
    <a href="{{ route('user.logout') }}">Logout</a>
</div>
@include('alerts')
<div class="d-flex justify-content-center align-items-center flex-column">
    <h6>{{ $user->name }}</h6>
    <h6>{{ $user->email }}</h6>
    @if (!empty($children))
        <ul>
            @foreach($children as $child)
                @for ($i = 0; $i < $child->lvl; $i++)
                    <ul>
                        <li>
                            @endfor
<span>{{$child->email}} <b>{{$child->lvl}}</b></span> <br>
                            @for ($i = 0; $i < $child->lvl; $i++)
                        </li>
                    </ul>
                @endfor
            @endforeach
        </ul>
    @endif
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>
