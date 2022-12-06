<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Form Roadstar</title>
</head>
<body>
    <h5>Hi,{{$data["name"]}}</h5>
    <p>Your Drop booking 
        S0122-4990395 @ <span>{{$data["time"]}}</span>, <span>{{$data["date"]}}</span> <span>{{$data["pickup"]}}</span> is confirmed.</p>
</body>
</html>