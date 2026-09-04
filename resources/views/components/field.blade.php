@props([
    'label' => NULL,
    'name' => NULL,
    'id' => NULL,
    'placeholder' => NULL,
    'required' => false,
    'value' => NULL,
    'type' => 'text'
])

<div class="form-group" id="{{ $id ?? $name }}">
    @if(!empty($label))
        <label class="mb-1.5 block text-sm font-medium text-gray-700" for="{{ $name }}">
            {{ $label }}{!! $required ? "<span class='text-error-500'>*</span>" : "" !!}
        </label>
    @endif

    <div class="relative">
        <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
            required="{{ $required }}" class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full
            rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
            placeholder:text-gray-400 focus:ring-3 focus:outline-hidden" />
        {{ $slot }}
    </div>
</div>
