{{--
    Item to be contained within an accordion

    NOTE: enforcing a set const height would ensure smooth animation later...
--}}
{{--
    tag - html element of component
    height - height of each component, ensures smooth calculation of animation
    slot - the contained text of the element, i.e. a tag
--}}
@props(['tag' => 'div', 'filter' => 'none'])
<{{ $tag }} {{ $attributes->merge(['data-filter' => $filter, 'class' => 'accordion-filter w-full py-1 px-2 hover:bg-white/5 rounded-xl cursor-pointer']) }}>
    {{ $slot }}
</{{ $tag }}>
