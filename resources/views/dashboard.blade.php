@extends('layouts.admin')
@section('content')
<!-- write main code -->
<body>
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

@stop
