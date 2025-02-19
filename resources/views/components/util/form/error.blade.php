@props(['name'])
@foreach ($errors->get($name) as $error)
    <p class="font-semibold text-sm text-red-600 mt-1">{{ $error }}</p>
@endforeach
