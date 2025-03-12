@props(['src', 'alt'])
<div class="slides">
    <div {{ $attributes->merge(['class' => 'transition-transform duration-[400ms] ease-in-out pt-10 sm:flex']) }}>
        <img class="flex lg:pl-10 w-70 rounded-xs object-cover" src="{{ $src }}" alt="{{ $alt }}">
    </div>
</div>
