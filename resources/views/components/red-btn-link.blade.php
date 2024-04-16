<a {!! $attributes->merge([
    'class' => 'inline-flex items-center px-4 py-2 bg-red-600 dark:bg-rose-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-rose-700 focus:bg-red-700 dark:focus:bg-red-500 active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150'
]) !!}>
    {{ $slot }}
</a>
