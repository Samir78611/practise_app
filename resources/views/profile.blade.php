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
    
    <form action="" method="POST">
        @csrf
    <h1>Signup Form</h1>
    <p>please fill this form to create an account</p>
    <hr>

    <label for="">Name:</label>
    <input type="text" id="name" name="name" placeholder="Name" value="{{$profile[0]->name}}" required>
    <br>
    <label for="">Last Name:</label>
    <input type="text" id="lname" name="lname" placeholder="Last Name"value="{{$profile[0]->lname}}"required>
    <br>
    <label for="">Email:</label>
    <input type="email" id="email" name="email" placeholder="Email" value="{{$profile[0]->email}}"required>
    <br>
    <label for="">Gender:</label>
    <input type="radio" id="gender" name="gender" value="Male" @if($profile[0]->gender=='Male') checked @endif><label for=""required>Male</label>
    <input type="radio" id="gender" name="gender" value="Female" @if($profile[0]->gender=='Female') checked @endif><label for=""required>Female</label>
    <input type="radio" id="gender" name="gender" value="Other" @if($profile[0]->gender=='Other') checked @endif><label for=""required>Other</label>
    <br>
    <label for="">Religion:</label>
    <input type="radio"id="religion" name="religion" value="Hindu" @if($profile[0]->religion=='Hindu') checked @endif required><label for="">Hindu</label>
    <input type="radio"id="religion" name="religion" value="Muslim"@if($profile[0]->religion=='Muslim') checked @endif required><label for="">Muslim</label>
    <input type="radio"id="religion" name="religion" value="Other"  @if($profile[0]->religion=='Other') checked @endif required><label for="">Other</label>
    <br>
<label for="">Hobbies:</label>
@php
$hobbies=$profile[0]->hobbies;
$hobbies_array=explode(',',$hobbies);
@endphp
<input type="checkbox" id="hobbies" name="hobbies[]" value="singing"{{in_array('singing', old('hobbies', []))? 'checked': ''}} {{in_array('singing', $hobbies_array) ? 'checked': ''}}>singing
<input type="checkbox" id="hobbies" name="hobbies[]" value="cricket"{{in_array('cricket', old('hobbies', []))? 'checked': ''}} {{in_array('cricket', $hobbies_array) ? 'checked': ''}}>cricket
<input type="checkbox" id="hobbies" name="hobbies[]" value="football"{{in_array('football', old('hobbies', []))? 'checked': ''}} {{in_array('football', $hobbies_array) ? 'checked': ''}}>football
<br>
<label for="">Mobile Number:</label>
<input type="number" id="mobile_no" name="mobile_no" placeholder="Mobile Number" value="{{$profile[0]->mobile_no}}"required>
<br>

<label for="">Date Of Birth:</label>
<input type="Date" id="date_of_birth" name="date_of_birth" value="{{$profile[0]->date_of_birth}}" required><br>
<label for="">Adhaar Number:</label>
<input type="number" id="adhaar_no" name="adhaar_no" placeholder="Adhaar Number" value="{{$profile[0]->adhaar_no}}"required>
<br>
<label for="">By creating an account you are agree to our <a href="#">Terms and Privacy.</a> </label>
<br>
<input type="Reset"><input type="Submit">
</form>
</body>
</html>