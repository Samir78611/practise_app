<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
        body {
            margin: 0px;
            background-color: white;
        }

        .navbar {
            background-color: #DFABDE;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: end;
        }

        .navbar h3{
            display: inline;
        }
        .navbar a{
            display: inline;
        }

        .logo img {
            width: 60px;
            height: 60px;

        }

        .user-info {
            text-align: right;
            margin-right: 10px;
        }
        .user-info img{
            border-radius:50%;
            width: 50px;
            height: 50px:
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

    <!-- <h1>Welcome {{ $fname }} {{ $lname }}</h1>
    <a href="{{ url('logout') }}">Logout</a>
    <br> -->


    <div class="navbar">

        <div class="user-info">
            <h3>{{ $fname }} {{ $lname }}</h3><br>
            <img src="{{url('images/'.$image)}}" alt="">
            <a href="{{ url('logout') }}"  class="btn btn-danger">Logout</a>

        </div>
    </div>
    <h2>
        <a href="{{ url('blogs') }}">Blogs</a> | <a
            href="{{ url('cars') }}">Cars</a>
    </h2>



    <table border=1>
        <tr>
            <th>id</th>
            <th>Image</th>
            <th>name</th>
            <th>lname</th>
            <th>gender</th>
            <th>Email</th>
            <th>Date Of Birth</th>
            <th>Adhaar No.</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tr>
            @foreach($users_data as $user)
                <td>{{ $user->id }}</td>
                <td><img src="{{ url('images/'.$user->image) }}" alt=""></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->lname }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->date_of_birth }}</td>
                <td>{{ $user->adhaar_no }}</td>
                <td><a href="{{ url('edit_user/'.$user->id) }}"  class="btn btn-success">Edit</a></td>
                <td><a href="{{ url('delete_user/'.$user->id) }}"  class="btn btn-danger">Delete</a></td>

        </tr>
        @endforeach
    </table>
</body>

</html>
