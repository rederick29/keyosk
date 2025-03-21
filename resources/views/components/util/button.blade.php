{{--
    Basic dropdown link component (looks confusing at first but it does make sense)

    Author(s): Ben Snaith : Main Developer

--}}
@props(['type'])
<{{ $type }} {{ $attributes->merge(['class' => 'dropdown-link cursor-pointer', 'href' => '/']) }}>
    {{ $slot }}
</{{ $type }}>
