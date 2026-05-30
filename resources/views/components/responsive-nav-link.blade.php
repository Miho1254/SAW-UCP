@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center space-x-2 w-full ps-3 pe-4 py-2 border-l-4 border-[#586DC0] text-start text-base font-medium text-[#586DC0] bg-gray-700/50 transition-all duration-200 ease-in-out'
            : 'inline-flex items-center space-x-2 w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#787878] hover:text-[#C2C2C2] hover:bg-gray-700/50 hover:border-gray-600 transition-all duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
