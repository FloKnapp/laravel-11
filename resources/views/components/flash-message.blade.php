<div {{ $attributes->only('class')->merge(['class' => 'opacity-100 absolute w-full z-20 dark:bg-gray-800 p-6 left-[50%] translate-x-[-50%] text-center']) }}
     x-data="{ flashMessage: false }"
     x-init="if ($refs.toast.textContent.trim() !== '') { flashMessage = true; setTimeout(() => flashMessage = false, 3000) }"
     x-show="flashMessage"
     x-ref="toast"
     x-transition:enter="transition-opacity ease-out duration-500"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-500"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    {{ $slot }}
</div>
