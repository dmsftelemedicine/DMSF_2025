@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-bg-[#7CAD3E] focus:ring-bg-[#7CAD3E] rounded-md shadow-sm']) !!}>
