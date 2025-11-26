@props(['variant' => 'info', 'dismissible' => false])

@php
$colors = [
    'success' => 'bg-green-50 text-green-800 border-green-200 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800',
    'error' => 'bg-red-50 text-red-800 border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800',
    'warning' => 'bg-yellow-50 text-yellow-800 border-yellow-200 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-800',
    'info' => 'bg-blue-50 text-blue-800 border-blue-200 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800',
];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-lg border p-4 ' . ($colors[$variant] ?? $colors['info'])]) }} x-data="{ show: true }" x-show="show" x-transition>
    <div class="flex items-start justify-between">
        <div class="flex-1">
            {{ $slot }}
        </div>
        @if($dismissible)
        <button @click="show = false" type="button" class="ml-3 inline-flex rounded-md p-1.5 hover:bg-black/5 dark:hover:bg-white/5">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
            </svg>
        </button>
        @endif
    </div>
</div>
