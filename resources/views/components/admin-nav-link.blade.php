@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-purple-300 rounded-r-full dark:bg-purple-500 dark:hover:bg-purple-400 dark:focus:bg-purple-400 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-purple-400 focus:bg-purple-300 focus:outline-none focus:shadow-outline'
            : 'block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-r-full dark:bg-transparent dark:hover:bg-purple-600 dark:focus:bg-purple-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-purple-300 focus:bg-purple-300 focus:outline-none focus:shadow-outline';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
