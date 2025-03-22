<script nonce="{{ csp_nonce() }}">
    {{-- Stops the flicker of dark/light mode on a new page, remember HTML runs top-down! --}}
    const isDarkMode = localStorage.getItem('color-theme') === 'dark' ||
        (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);

    if (isDarkMode) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

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
