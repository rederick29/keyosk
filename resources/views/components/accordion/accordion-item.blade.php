{{--
    Item to be contained within an accordion

    NOTE: enforcing a set const height would ensure smooth animation later...
--}}
{{--
    tag - html element of component
    height - height of each component, ensures smooth calculation of animation
    slot - the contained text of the element, i.e. a tag
--}}
@props(['tag' => 'div'])
<{{ $tag }} {{ $attributes->merge(['class' => 'w-full py-1 indent-2 hover:bg-white/5 rounded-xl cursor-pointer']) }}>
    {{ $slot }}
</{{ $tag }}>
