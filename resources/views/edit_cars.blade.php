<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Collection</title>
</head>
<body>
    <h1> Edit Car Collection </h1>
    <hr>
    @if($errors->any())
        @foreach($errors->all() as $error)
        <h1 style="color:red">{{$error}}</h1>
        @endforeach
    @endif

    @if(Session::has('success'))
    <h1 style="color:#006600">{{Session::get('success')}}</h1>
    @endif

    <form action="{{url('update_cars')}}" method="POST" enctype="multipart/form-data"> 
        @csrf

        <input type="hidden" id="id" name="id" value="{{$edit_cars[0]->id}}">
        <label for="">Car name:</label>
        <input type="text" id="car" name="car" placeholder="Car name" value="{{$edit_cars[0]->car}}" required ><br>

        <label for="">Model:</label>
        <input type="text" id="model" name="model" placeholder="Model" value="{{$edit_cars[0]->model}}"required><br>

        <label for="">Milege:</label>
        <input type="text" id="milege" name="milege" placeholder="Milege" value="{{$edit_cars[0]->milege}}"required><br>

        <label for="">Price:</label>
        <input type="text" id="price" name="price" placeholder="Price" value="{{$edit_cars[0]->price}}"required><br>

        <label for="">Which color do you have ?:</label><br>
        <input type="radio" id="color" name="color" value="black"  @if($edit_cars[0]->color=='black') checked @endif ><label for="">Black</label>
        <input type="radio" id="color" name="color" value="white" @if($edit_cars[0]->color=='white') checked @endif ><label for="">White</label>
        <input type="radio" id="color" name="color" value="red" @if($edit_cars[0]->color=='red') checked @endif ><label for="">Red</label>
        <input type="radio" id="color" name="color" value="blue" @if($edit_cars[0]->color=='blue') checked @endif ><label for="">Blue</label>
        <br>
        <label for="">Upload An Image</label><br>
        <img src="{{url('uploads/'.$edit_cars[0]->image)}}" alt="">
        <input type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg"> <br><br>

        <label for="">Upload Manual</label><br>
        <input type="file" id="pdf" name="pdf" value="{{url('downloads/'.$edit_cars[0]->pdf)}}" accept="application/pdf"> <br><br>

        <input type="submit" value="Update">

    </form>
</body>
</html>