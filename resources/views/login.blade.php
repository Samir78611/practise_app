<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
        body {
            background-color: #E9EBF1;

        }

        .card {
            margin-left: 500px;
            margin-right: 500px;
            margin-top: 60px;
        }

    </style>
</head>

<body>
    @if(Session::has('success'))
        <h1 style="color:#006666">{{ Session::get('success') }}</h1>
    @endif

    @if(Session::has('fail'))
        <h1 style="color:#ff0000">{{ Session::get('fail') }}</h1>
    @endif

    <img src="url('public/bg.jpeg')" class="img" alt="">
    <form action="{{ url('login-user') }}" method="POST">
        @csrf

        <div class="card" style="width: 18rem;">
            <div class="card-body">

                <h1>Login Form</h1>
                <p>Login here to move ahead</p>
                <hr>

                <label for="">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email"><br>

                <label for="">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <br>
                <input type="Reset" class="btn btn-danger">
                <input type="submit" id="submit" class="btn btn-success" name="submit" value="login">
                <p>if you don't have account <a href="{{ url('signup') }}">signup here</a></p>
            </div>

            <div class="flex items-center justify-end mt-4 align-middle ">
                <a href="{{url('auth/google') }}">
                    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                </a>
            </div>
        </div>
    </form>
</body>

</html>
