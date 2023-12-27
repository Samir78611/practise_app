@extends('layouts.admin')
@section('content')
<body>

@if(Session::has('success'))
<h1 style="color:#006600">{{Session::get('success')}}</h1>
@endif

@if(Session::has('fail'))
<h1 style="color:#ff0000">{{Session::get('fail')}}</h1>
@endif

<h1>Send Offer to Customer</h1>
<form action="{{url('users_offer')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="">Title of this offer</label><br>
    <input type="text" id="title" name="title" value=""><br>

    <label for="">Description of this offer</label><br>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    <br>

    <input type="reset">
    <input type="submit">
</form>
</body>
@stop
