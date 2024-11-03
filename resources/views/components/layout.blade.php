
{{--
    This is the generic layout for the site,
    including static elements which should remain
    consistent across the site

    Author(s): Ben Snaith
--}}

<!doctype html>
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

    {{-- Title can be passed as <x-slot:title>, however by default it will use "Keytamine" --}}
    <title>{{ $title ?? "Keytamine" }}</title>
</head>
<body class="bg-black relative">
    <x-navbar />
    {{ $slot }}
</body>
</html>
