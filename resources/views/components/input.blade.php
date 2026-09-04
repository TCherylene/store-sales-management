@props([
    'name',
    'value' => NULL,
    'type' => 'text'
])

<input type="{{ $type }}" name="{{ $name }}">
