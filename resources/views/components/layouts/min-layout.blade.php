
{{--
    This is the layout for the elemnents of the site
    that do not require the nav or footer (e.g. login etc)

    Author(s): Ben Snaith : Main Developer
--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--
     Also slightly random but things included up here will be added into the site if the syntax is off, found this
     out the hard way :/
    --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <x-util.global-scripts/>

    {{-- Title can be passed as <x-slot:title>, however by default it will use "Keytamine" --}}
    <title>{{ $title ?? "Keyosk" }}</title>
</head>
<body class="bg-white dark:bg-zinc-950 relative h-fit text-zinc-800 dark:text-neutral-200">
    {{ $slot }}
</body>
</html>
