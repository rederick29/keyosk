<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Name: {{ $mail['first-name'].' '.$mail['last-name'] }} </p>
    <p>Email: {{ $mail['email'] }} </p>
    <p>Message: {{ $mail['message'] }} </p>
</body>
</html>