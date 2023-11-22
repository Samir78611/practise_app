<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Collection</title>
</head>
<body>
    <h1>Car Collection </h1>
    <hr>
    @if($errors->any())
        @foreach($errors->all() as $error)
        <h1 style="color:red">{{$error}}</h1>
        @endforeach
    @endif

    @if(Session::has('success'))
    <h1 style="color:#006600">{{Session::get('success')}}</h1>
    @endif

    @if(Session::has('fail'))
    <h1 style="color:#ff0000">{{Session::get('fail')}}</h1>
    @endif

    <form action="{{url('cars_1')}}" method="POST" enctype="multipart/form-data"> 
        @csrf
        <label for="">Car name:</label>
        <input type="text" id="car" name="car" placeholder="Car name" value="" required ><br>

        <label for="">Model:</label>
        <input type="text" id="model" name="model" placeholder="Model" value=""required><br>

        <label for="">Milege:</label>
        <input type="text" id="milege" name="milege" placeholder="Milege" value=""required><br>

        <label for="">Price:</label>
        <input type="text" id="price" name="price" placeholder="Price" value=""required><br>

        <label for="">Which color do you have ?:</label><br>
        <input type="radio" id="color" name="color" value="black"><label for="">Black</label>
        <input type="radio" id="color" name="color" value="white"><label for="">White</label>
        <input type="radio" id="color" name="color" value="red"><label for="">Red</label>
        <input type="radio" id="color" name="color" value="blue"><label for="">Blue</label>
        <br><br>

        <label for="">Upload An Image</label><br>
        <input type="file" id="image" name="image"  accept="image/png, image/gif, image/jpeg"   > <br><br>

        <label for="">Upload Manual</label><br>
        <input type="file" id="pdf" name="pdf" accept="application/pdf"> <br><br>
        <input type="submit">

        <label for=""><h1>List Of Cars Collection </h1></label><br>
        <hr>
        <table border="1">
            <tr>
            <th>Id</th>
            <th>Car</th>
            <th>Model</th>
            <th>Milege</th>
            <th>Price</th>
            <th>Color</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Image</th>
            <th>Download Manual</th>
            </tr>
            <tr>
                
        @foreach($cars as $car)
            <td>{{$car->id}}</td>
            <td>{{$car->car}}</td>
            <td>{{$car->model}}</td>
            <td>{{$car->milege}}</td>
            <td>{{$car->price}}</td>
            <td>{{$car->color}}</td>
            <td><a href="{{url('edit_cars/'.$car->id)}}">Edit</a></td>
            <td><a href="{{url('delete_cars/'.$car->id)}}">Delete</a></td>

            @if($car->image!="")
            <td><img src="{{url('uploads/'.$car->image)}}" alt="" width=250 height=200></td>
            @else 
            @endif

            <td>
                @if($car->pdf!="")
                <a href="{{url('downloads/'.$car->pdf)}}" target="_blank">Downlaod manual</a>
                @else
                <p>No PDF</p>
                @endif
            </td>
            </tr>
        @endforeach 
        </table>

    </form>
</body>
</html>