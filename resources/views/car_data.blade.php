<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Car data</title>
</head>
<body>
<label for="dataInput">Enter Car Data:</label>
    <input type="text" id="dataInput" placeholder="Type something...">

    <button onclick="postData()" class="btn btn-success">Submit</button>
   <input type="text" id="name" placeholder="Details of Car" >
   <input type="text" id="model" placeholder="Details of model">
   <input type="text" id="color" placeholder="Details of model">
   <input type="text" id="price" placeholder="Details of price">

    <br>
    <script>
        function postData() {
            // Get the value from the input box
            var inputData = document.getElementById("dataInput").value;

            // Prepare the data to be sent in the request body
            var data = {
                key: "value",  // Add your data properties here
                car: inputData
            };

            // Make a POST request using the fetch API
            fetch("http://localhost:8000/api/details_of_cars", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Add any additional headers if needed
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(jsonResponse => {
                // Process the JSON response
                var response=jsonResponse;
                var data=jsonResponse.data;

                //data_of_cars_collection
                var carname=data.car;
                var modelNo=data.model;
                var color=data.color;
                var price=data.price;

                // console.log(color);

                document.getElementById("name").value=carname;
                document.getElementById("model").value=modelNo;
                document.getElementById("color").value=color;
                document.getElementById("price").value=price;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        }
    </script>
</body>
</html>
