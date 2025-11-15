@props(['name' => null,'label' => null, 'value' => null])


<div class="m-3 p-3 flex flex-col">
    <label for="{{ $name }}">{{ $label??ucfirst($name) }}:</label>
    <input type="text" name="{{$name}}" id="{{$name}}" {{ value($value) }} class="border p-2">
</div>
