
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

    @vite('resources/css/app.css')
    <script src="../../js/app.js" defer></script>

    <title>{{ $title ?? "Keytamine" }}</title>
</head>
<body class="bg-zinc-900 relative">
    <x-navbar />
    {{ $slot }}
</body>
</html>
