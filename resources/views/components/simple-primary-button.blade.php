
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'p-3 size-max justify-self-end bg-blue-400 width-max rounded-lg cursor-pointer text-gray-100 dark:text-gray-900']) }}>
    {{ $slot }}
</button>
