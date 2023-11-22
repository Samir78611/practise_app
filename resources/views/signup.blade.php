<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
</head>
<body>
    @if($errors->any())
        @foreach($errors->all() as $error)
        <h1 style="color:red">{{$error}}</h1>
        @endforeach
    @endif
    
    <form action="{{url('signup-user')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <h1>Signup Form</h1>
    <p>please fill this form to create an account</p>
    <hr>

    <label for="">Name:</label>
    <input type="text" id="name" name="name" placeholder="Name" value="{{old('name')}}" required>
    <br>
    <label for="">Last Name:</label>
    <input type="text" id="lname" name="lname" placeholder="Last Name"value="{{old('lname')}}"required>
    <br>
    <label for="">Email:</label>
    <input type="email" id="email" name="email" placeholder="Email" value="{{old('email')}}"required>
    <br>
    <label for="">Password:</label>
    <input type="password" id="password" name="password" placeholder="Password"required>
    <br>
    <label for="">Gender:</label>
    <input type="radio" id="gender" name="gender" value="Male" @if(old('gender')=='Male') checked @endif><label for=""required>Male</label>
    <input type="radio" id="gender" name="gender" value="Female" @if(old('gender')=='Female') checked @endif><label for=""required>Female</label>
    <input type="radio" id="gender" name="gender" value="Other" @if(old('gender')=='Other') checked @endif><label for=""required>Other</label>
    <br>
    <label for="">Religion:</label>
    <input type="radio"id="religion" name="religion" value="Hindu" @if(old('religion')=='Hindu') checked @endif required><label for="">Hindu</label>
    <input type="radio"id="religion" name="religion" value="Muslim" @if(old('religion')=='Muslim') checked @endif required><label for="">Muslim</label>
    <input type="radio"id="religion" name="religion" value="Other"  @if(old('religion')=='Other') checked @endif required><label for="">Other</label>
    <br>
<label for="">Hobbies:</label>
<input type="checkbox" id="hobbies" name="hobbies[]" value="singing"{{in_array('singing', old('hobbies', []))? 'checked': ''}}>singing
<input type="checkbox" id="hobbies" name="hobbies[]" value="cricket"{{in_array('cricket', old('hobbies', []))? 'checked': ''}}>cricket
<input type="checkbox" id="hobbies" name="hobbies[]" value="football"{{in_array('football', old('hobbies', []))? 'checked': ''}}>football
<br>
<label for="">Mobile Number:</label>
<input type="number" id="mobile_no" name="mobile_no" placeholder="Mobile Number" value=""required>
<br>

<label for="">Date Of Birth:</label>
<input type="Date" id="date_of_birth" name="date_of_birth" value="{{old('date_of_birth')}}" required><br>
<label for="">Adhaar Number:</label>
<input type="number" id="adhaar_no" name="adhaar_no" placeholder="Adhaar Number" value="{{old('adhaar_no')}}"required>
<br>

<label for="">Upload an profile</label><br>
<input type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg">
<br>
<br>
<label for="">By creating an account you are agree to our <a href="#">Terms and Privacy.</a> </label>
<br>
<input type="Reset"><input type="Submit">
<br>
<p>Already have account ? <a href="{{url('login')}}">Login</a></p> 
</form>
</body>
</html>