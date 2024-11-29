@props(['name'])
@error('name')
    <p class="font-semibold text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror
