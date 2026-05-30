@props(['icon', 'active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center space-x-2 px-3 py-4 border-b-4 border-[#586DC0] text-sm font-medium leading-5 text-[#586DC0] transition-all duration-200 ease-in-out'
            : 'inline-flex items-center space-x-2 px-3 py-4 border-b-4 border-transparent text-sm font-medium leading-5 text-[#787878] hover:text-[#C2C2C2] hover:border-[#C2C2C2] transition-all duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{$slot}}
</a>
