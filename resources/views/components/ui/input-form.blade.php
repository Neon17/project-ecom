@props(['name' => null, 'label' => null, 'value' => null, 'type' => 'text'])

<div class="m-3 p-3 flex flex-col">
    <label for="{{ $name }}">{{ $label ?? ucfirst($name) }}:</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value ?? '' }}"
        class="border p-2 rounded" {{ $attributes }}>
    @error($name)
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
