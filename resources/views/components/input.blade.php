@props(['disabled' => false])
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400']) !!}>
