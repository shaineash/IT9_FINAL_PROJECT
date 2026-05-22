@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#c9a77c] text-start text-base font-medium text-[#f5f5f0] bg-[#111111] focus:outline-none focus:text-[#f5f5f0] focus:bg-[#111111] focus:border-[#c9a77c] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#b0b0b0] hover:text-[#f5f5f0] hover:bg-[#111111] hover:border-[#c9a77c] focus:outline-none focus:text-[#f5f5f0] focus:bg-[#111111] focus:border-[#c9a77c] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
