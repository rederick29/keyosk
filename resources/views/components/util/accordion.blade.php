@props(['heading'])
<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <input type="checkbox" class="accordion-checkbox" id="accordion-title">
    <label class="accordion-title w-full h-10 px-5 flex items-center justify-between" for="accordion-title">
        {{ $heading }}
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15l-6-6-6 6"/></svg>
    </label>
    <div class="accordion-content">
        {{ $slot }}
    </div>
</div>
