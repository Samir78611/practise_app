<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> -->
    <style>
        body {
            margin: 0;
            background-color: white;
        }

        .navbar {
            background-color: #1c7299;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Change to 'center' for better alignment */
        }

        .navbar h3,
        .navbar a {
            display: inline-block;
            /* Change to 'inline-block' for better positioning */
            margin: 0;
            /* Remove unnecessary margin */
        }

        .logo img {
            width: 60px;
            height: 60px;
        }

        .user-info {
            text-align: right;
            margin-right: 10px;
        }

        .user-info img {
            width: 53px;
            height: 60px;
            margin-right: 10px;
            /* Adjust margin for better spacing */
        }

    </style>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
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
            <img src="{{ url('logo/user-interface.png') }}" alt="">
            <a href="{{ url('logout') }}" class="btn btn-danger">Logout</a>

        </div>
    </div>
    <h2>
        <a href="{{ url('blogs') }}">Blogs</a> | <a
            href="{{ url('cars') }}">Cars</a> |
        <a href="{{ url('offer') }}">Zomato Offer</a>
    </h2>



    <table border=1>
        <tr>
            <th>id</th>
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
                <td>{{ $user->name }}</td>
                <td>{{ $user->lname }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->date_of_birth }}</td>
                <td>{{ $user->adhaar_no }}</td>
                <td><a href="{{ url('edit_user/'.$user->id) }}" class="btn btn-success">Edit</a>
                </td>
                <td><a href="{{ url('delete_user/'.$user->id) }}"
                        class="btn btn-danger">Delete</a></td>

        </tr>
        @endforeach
    </table>
    <h1>Calculator</h1>

    <h2>Addition</h2>

    <!-- Trigger/Open The Modal -->
    <button id="myBtn">Calculator</button>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="">
                <input type="text" id="value1" name="value1" placeholder="Enter First Digit" value="">
                <select id="operator" name="operator">
                    <option value="add">+</option>
                    <option value="subtract">-</option>
                    <option value="multiply">*</option>
                    <option value="divide">/</option>
                </select>
                <input type="text" id="value2" name="value2" placeholder="Enter Second Digit" value="">
                <input type="button" onclick="calculate()" value="Calculate">
                <input type="text" id="demo" name="demo" value="">
            </form>

        </div>

    </div>
    <br>

    <h2>Search for Username</h2>
    <h3 id="status" style="color:green"></h3>
    <input type="text" id="textBoxId" placeholder="Enter text">
    <button onclick="postData()">Get data</button>
    <br>
    <input type="text" id="fname">
    <br>
    <input type="text" id="lname">
    <br>
    <input type="text" id="hobbies">

    <script>
        function calculate() {
            var value_one = parseFloat(document.getElementById("value1").value);
            var value_two = parseFloat(document.getElementById("value2").value);
            var operator = document.getElementById("operator").value;
            var result;

            switch (operator) {
                case 'add':
                    result = value_one + value_two;
                    break;
                case 'subtract':
                    result = value_one - value_two;
                    break;
                case 'multiply':
                    result = value_one * value_two;
                    break;
                case 'divide':
                    if (value_two !== 0) {
                        result = value_one / value_two;
                    } else {
                        alert("Cannot divide by zero!");
                        return;
                    }
                    break;
                default:
                    alert("Invalid operator");
                    return;
            }

            document.getElementById("demo").value = result;
        }

    </script>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>
    <script>
 function postData() {
    // Get the value entered by the user
    var inputValue = document.getElementById('textBoxId').value;
    

    // Prepare the data to be sent
    var data = {
        name: inputValue
    };
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: POST-request, URL, async
    xhr.open('POST', 'http://localhost:8000/api/get_user_name', true);

    // Set the request header to indicate the content type is JSON
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Define the callback function to handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the successful response
                var responseData = JSON.parse(xhr.responseText);
                var data=responseData.data;
                var status=responseData.status;
                if(status==200){
//details
                var fname=data.name;
                var lname=data.lname;
                var hobbies=data.hobbies;
//seen this in dashboard with succesfull.
                document.getElementById("status").innerHTML="user found Hurray";

                document.getElementById("fname").value=fname;
                document.getElementById("lname").value=lname;
                document.getElementById("hobbies").value=hobbies;
                }else{
                    //seen this in dashboard with succesfull.
                    document.getElementById("status").innerHTML="user Not found badly try";
                }
            } else {
                // Handle errors
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };

    // Convert the data to JSON and send the request
    xhr.send(JSON.stringify(data));
}

// The following line is removed from here
// xhr.send();

    </script>
</body>

</html>
