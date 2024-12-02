
{{--
    Search bar element.

    Author(s): Toms Xavi: Developer
--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-zinc-800">

    <div class="relative rounded-lg bg-zinc-900 shadow-lg w-80 max-w-full text-white overflow-hidden transition-transform transform hover:scale-105 hover:shadow-[0px_0px_20px_rgba(139,92,246,0.5)]">
        <img src="path-to-your-image.jpg" alt="Card Background" class="absolute inset-0 w-full h-full object-cover opacity-60">
        <div class="relative z-10 p-6 h-full flex flex-col justify-end items-center text-center bg-gradient-to-t from-zinc-900/80 to-transparent">
            <div class="w-16 h-16 bg-zinc-700 rounded-full flex items-center justify-center mb-4">
            </div>
            <div>
                <h3 class="text-xl font-semibold">Card Title</h3>
                <p class="text-sm text-zinc-400 mt-2">Some description text.</p>
            </div>
            <div class="mt-6">
                {{ $slot }}
            </div>
        </div>
    </div>

</body>
</html>
