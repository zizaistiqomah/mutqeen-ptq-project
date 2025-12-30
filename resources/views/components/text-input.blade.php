@props(['disabled' => false, 'suffixIcon' => null, 'type' => 'text'])

<div class="relative">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm pr-10',
    ]) !!} type="{{ $type }}">
    @if ($suffixIcon)
        <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" id="{{ $suffixIcon }}">
            <i class="fa fa-eye"></i>
        </button>
    @endif
</div>
