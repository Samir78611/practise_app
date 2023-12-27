@extends('layouts.admin')
@section('content')
<body>
    @if($errors->any())
    @foreach($errors->all() as $error)
    <h1 style="color:#ff0000">{{$error}}</h1>
    @endforeach
    @endif

    @if(Session::has('success'))
    <h1 style="color:#006600">{{Session::get('success')}}</h1>
    @endif

    @if(Session::has('fail'))
    <h1 style="color:#ff0000">{{Session::get('fail')}}</h1>
    @endif

    <h1>Blogs</h1>
    <form action="{{url('create-blogs')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="">Title of this blog</label><br>
        <input type="text" id="title" name="title" value=""><br>

        <label for="">Description of this blog</label><br>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <br>
        <label for="">Upload An Image</label><br>
        <input type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg"><br><br>

        <label for="">Upload Blog PDF</label><br>
        <input type="file" id="pdf" name="pdf" accept="application/pdf"><br><br>

        <input type="reset">
        <input type="submit">

        <h1>Latest Blogs</h1>
        <hr>
        @foreach($get_blogs as $blog)
            <h2>{{$blog->title}}</h2>
            @if($blog->image!="")
            <img src="{{url('uploads/'.$blog->image)}}" alt="" width=200 height=200>
            @else
            <p>No Image</p>
            @endif
            <p>{{$blog->description}} </p>
            <br>
            <a href="{{url('edit_blogs/'.$blog->id)}}">Edit</a>
            <a href="{{url('delete_blog/'.$blog->id)}}">Delete</a> 
            
            <a href="{{url('pdf_blogs/'.$blog->pdf_blogs)}}">Download Manual</a>
        @endforeach
    </form>
</body>
@stop