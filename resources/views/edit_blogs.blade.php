<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit Blogs</title>
</head>
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
    <form action="{{url('update_blogs')}}" method="post" enctype="multipart/form-data">
        @csrf
    <h1>Edit Blogs</h1>
    <hr>
    
        <input type="hidden" id="id" name="id" value="{{$edit_blog[0]->id}}"><br>


        <label for="">Title of this blog</label><br>
        <input type="text" id="title" name="title" value="{{$edit_blog[0]->title}}"><br>

        <label for="">Description of this blog</label><br>
        <textarea name="description" id="description" cols="30" rows="10" >{{$edit_blog[0]->description}}</textarea>
        <br>
        <label for="">Upload An Image</label><br>
        <input type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg"><br><br>

        <label for="">Upload Blog PDF</label><br>
        <input type="file" id="pdf" name="pdf" accept="application/pdf"><br><br>

        <br>
        <input type="reset">
        <input type="submit">
        
    </form>
</body>
</html>