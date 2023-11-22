<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    @if($errors->any())
        @foreach($errors->all() as $error)
        <h1 style="color:red">{{$error}}</h1>
        @endforeach
    @endif

    @if(Session::has('success'))
    <h1 style="color:#006666">{{Session::get('success')}}</h1>
    @endif

    <form action="{{url('update_user')}}" method="POST"  enctype="multipart/form-data">
        @csrf
    <h1>Edit User </h1>
    <p>please fill this form to create an account</p>
    <hr>

    <input type="hidden" id="id" name="id" value="{{$user_data[0]->id}}">

    <label for="">Name:</label>
    <input type="text" id="name" name="name" value="{{old('name')}} {{$user_data[0]->name}}" required>
    <br>
    <label for="">Last Name:</label>
    <input type="text" id="lname" name="lname" value="{{old('lname')}} {{$user_data[0]->lname}}"required>
    <br>
    <label for="">Email:</label>
    <input type="email" id="email" name="email"  value="{{old('email')}} {{$user_data[0]->email}}"required>
    
    <br>
    <label for="">Gender:</label>
    <input type="radio" id="gender" name="gender" value="Male" @if(old('gender')=='Male') checked @endif      @if($user_data[0]->gender=='Male') checked @endif><label for=""required>Male</label>
    <input type="radio" id="gender" name="gender" value="Female" @if(old('gender')=='Female') checked @endif  @if($user_data[0]->gender=='Female') checked @endif><label for=""required>Female</label>
    <input type="radio" id="gender" name="gender" value="Other" @if(old('gender')=='Other') checked @endif    @if($user_data[0]->gender=='Other') checked @endif><label for=""required>Other</label>
    <br>
    <label for="">Religion:</label>
    <input type="radio"id="religion" name="religion" value="Hindu" @if(old('religion')=='Hindu') checked @endif   @if($user_data[0]->religion=='Hindu') checked @endif required><label for="">Hindu</label>
    <input type="radio"id="religion" name="religion" value="Muslim" @if(old('religion')=='Muslim') checked @endif @if($user_data[0]->religion=='Muslim') checked @endif required><label for="">Muslim</label>
    <input type="radio"id="religion" name="religion" value="Other"  @if(old('religion')=='Other') checked @endif  @if($user_data[0]->religion=='Other') checked @endif required><labefor="">Other</label>
    <br>
<label for="">Hobbies:</label>
@php
$hobbies=$user_data[0]->hobbies;
$hobbies_array=explode(',',$hobbies)
@endphp
<input type="checkbox" id="hobbies" name="hobbies[]" value="singing"{{in_array('singing', old('hobbies', []))? 'checked': ''}} {{in_array('singing',    $hobbies_array)? 'checked': ''}}>singing
<input type="checkbox" id="hobbies" name="hobbies[]" value="cricket"{{in_array('cricket', old('hobbies', []))? 'checked': ''}} {{in_array('cricket',    $hobbies_array)? 'checked': ''}}>cricket
<input type="checkbox" id="hobbies" name="hobbies[]" value="football"{{in_array('football', old('hobbies', []))? 'checked': ''}} {{in_array('football', $hobbies_array)? 'checked': ''}}>football
<br>
<label for="">Mobile Number:</label>
<input type="number" id="mobile_no" name="mobile_no"  value= "{{$user_data[0]->mobile_no}}"required>
<br>

<label for="">Date Of Birth:</label>
<input type="Date" id="date_of_birth" name="date_of_birth" value= "{{$user_data[0]->date_of_birth}}" required><br>
<label for="">Adhaar Number:</label>
<input type="number" id="adhaar_no" name="adhaar_no" value="{{$user_data[0]->adhaar_no}}"required>
<br>
<label for="">By creating an account you are agree to our <a href="#">Terms and Privacy.</a> </label>
<br>

<label for="">Upload an profile</label><br>
<img src="{{url('images/'.$user_data[0]->image)}}" alt="">
<input type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg">
<br>
<br>
<input type="Reset"><input type="Submit">
<br>
<p>Already have account ? <a href="{{url('login')}}">Login</a></p> 
</form>
</body>
</html> 