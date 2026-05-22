@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#c9a77c] text-sm font-medium leading-5 text-[#f5f5f0] focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-[#b0b0b0] hover:text-[#f5f5f0] hover:border-[#c9a77c] focus:outline-none focus:text-[#f5f5f0] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
