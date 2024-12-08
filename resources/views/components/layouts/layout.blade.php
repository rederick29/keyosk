
{{--
    This is the generic layout for the site,
    including static elements which should remain
    consistent across the site

    Author(s): Ben Snaith : Main Developer, intns : Back-end Developer
--}}

<!doctype html>
<html lang="en" class="dark">
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

    {{-- Title can be passed as <x-slot:title>, however by default it will use "Keyosk" --}}
    <title>{{ $title ?? "Keyosk" }}</title>
</head>
<body class="bg-zinc-950 relative h-fit text-neutral-200">
    <x-navbar.navbar />
    {{ $slot }}
    <x-footer.footer />
</body>

{{-- IDK where to place this, but we should have it somewhere! --}}
@if (session()->has('success') || session()->has('error') || session()->has('info'))
<script nonce="{{ csp_nonce() }}">
    window.onload = () => {
        @if (session()->has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session()->has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (session()->has('info'))
            toastr.info("{{ session('info') }}");
        @endif
    };
</script>
@endif

</html>
