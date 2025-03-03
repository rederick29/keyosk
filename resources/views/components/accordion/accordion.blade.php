@props(['label' => 'Accordion'])
<div id="accordion-{{ $label }}" {{ $attributes->merge(['class' => 'accordion accordion-const accordion-closed ']) }}>
    <div class="toggle mb-[10px] flex items-center justify-between font-bold cursor-pointer">
        {{ $label}}
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
    </div>

    <!-- accordion content -->
    <div class="content w-full flex flex-col gap-1">
        {{ $slot }}
    </div>
</div>

<style>
    .accordion-const {
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: max-height 300ms ease;
    }

    .accordion-closed {
        max-height: 24px;
    }

    .accordion-closed > div > svg {
        transform: rotate(0deg);
        transition: transform 300ms ease;
    }

    .accordion-open {
    }

    .accordion-open > div > svg {
        transform: rotate(180deg);
        transition: transform 300ms ease;
    }
</style>
