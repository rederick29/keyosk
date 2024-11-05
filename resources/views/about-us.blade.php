<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>About us</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite("resources/css/app.css")
    </head>
</head>
<body class="bg-zinc-950 text-white">
    <x-navbar />
    <div class = "about-us pt-44">
        
        <h1 class = "text-center text-xl">About Us</h1>
        <p class = "text-center">Keyosk is a multi-product company that is dedicated to providing a top-notch experience to our customers. We take pride in the quality of our products and always strive towards innovation in the peripherals market. We have a strong focus on sustainability and want to make sure we contribute to saving the environment. </p>
        
        
    </div>
</body>
</html>