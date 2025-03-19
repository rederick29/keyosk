{{--
    This is the generic layout for the site,
    including static elements which should remain
    consistent across the site

    Author(s): Ben Snaith : Main Developer, intns : Back-end Developer
--}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Stops the flicker of dark/light mode on a new page, remember HTML runs top-down! --}}
    <script nonce="{{ csp_nonce() }}">
        const isDarkMode = localStorage.getItem('color-theme') === 'dark' ||
            (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isDarkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

{{--
     Also slightly random but things included up here will be added into the site if the syntax is off, found this
     out the hard way :/
    --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Title can be passed as <x-slot:title>, however by default it will use "Keyosk" --}}
    <title>{{ $title ?? 'Keyosk' }}</title>
</head>

<body class="bg-white dark:bg-zinc-950 relative h-fit text-zinc-800 dark:text-neutral-200">
    <x-navbar.navbar />
    {{ $slot }}
    <x-footer.footer />
</body>

{{-- IDK where to place this, but we should have it somewhere! --}}
<script nonce="{{ csp_nonce() }}">
    window.onload = () => {
        {{-- also check the browser session for these!! --}}
        if (sessionStorage.getItem('success')) {
            toastr.success(sessionStorage.getItem('success'));
            sessionStorage.removeItem('success');
        }
        if (sessionStorage.getItem('error')) {
            toastr.error(sessionStorage.getItem('error'));
            sessionStorage.removeItem('error');
        }
        if (sessionStorage.getItem('info')) {
            toastr.info(sessionStorage.getItem('info'));
            sessionStorage.removeItem('');
        }
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

</html>
