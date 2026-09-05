@props([
    'label' => NULL,
    'name' => NULL,
    'id' => NULL,
    'placeholder' => NULL,
    'required' => false,
    'value' => NULL,
    'description' => NULL,
    'class' => NULL,
    'type' => 'text',
    'items' => [],
    'prompt' => [],
])

<div class="form-group mb-3" id="{{ $id ?? $name }}">
    @if(!empty($label))
        <label class="mb-1.5 block text-sm font-medium text-gray-700" for="{{ $name }}">
            {{ $label }}{!! $required ? "<span class='text-error-500'>*</span>" : "" !!}
        </label>
    @endif

    @if($type == "dropdown")
        <select name="{{  $name }}" id="{{ $name }}" required="{{ $required }}" class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11
                rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                placeholder:text-gray-400 focus:ring-3 focus:outline-hidden {{ $class ?? "w-full" }}">
            @if (!empty($prompt))
                <option value="{{ NULL }}">
                    {{ $prompt }}
                </option>
            @endif
            @foreach ($items as $key => $val)
                <option value="{{ $key === null ? '' : $key }}" {{ (string) $key === (string) $value ? 'selected' : '' }}>
                    {{ $val }}
                </option>
            @endforeach
        </select>
    @else
        <div class="relative {{ $class ?? "w-full" }}">
            <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" @required($required)
                value="{{ $value }}" class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11
                    rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                    placeholder:text-gray-400 focus:ring-3 focus:outline-hidden w-full
                    read-only:bg-gray-100 read-only:hover:cursor-not-allowed" {{ $attributes }} />
            {{ $slot }}
        </div>

        @if($description)
            <i>
                <span class="text-gray-500 text-sm">{{ $description }}</span>
            </i>
        @endif
    @endif

    @error($name)
        <div class="text-sm text-red-500 mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
