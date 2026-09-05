@props([
    'route' => '',
])

<x-form action="{{ $route }}" method="DELETE">
    <x-button type="submit" icon="trash" color="danger">
    </x-button>
</x-form>
