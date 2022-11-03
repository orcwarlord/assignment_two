@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-emerald-300 bg-red-150 focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50']) !!}>
