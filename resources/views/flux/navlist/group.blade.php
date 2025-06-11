@props([
    'expandable' => false,
    'expanded' => true,
    'heading' => null,
])

<?php if ($expandable && $heading): ?>

<ui-disclosure
    {{ $attributes->class('group/disclosure') }}
    @if ($expanded === true) open @endif
    data-flux-navlist-group
>
    <button
        type="button"
        class="group/disclosure-button mb-[2px] flex h-10 w-full items-center rounded-lg text-zinc-500 hover:bg-zinc-800/5 hover:text-zinc-800 lg:h-8 dark:text-white/80 dark:hover:bg-white/[7%] dark:hover:text-white"
    >
        <div class="ps-3 pe-4">
            <flux:icon.chevron-down class="hidden size-3! group-data-open/disclosure-button:block" />
            <flux:icon.chevron-right class="block size-3! group-data-open/disclosure-button:hidden" />
        </div>

        <span class="text-sm font-medium leading-none">{{ $heading }}</span>
    </button>

    <div class="relative hidden space-y-[2px] ps-7 data-open:block" @if ($expanded === true) data-open @endif>
        <div class="absolute inset-y-[3px] start-0 ms-4 w-px bg-zinc-200 dark:bg-white/30"></div>

        {{ $slot }}
    </div>
</ui-disclosure>

<?php elseif ($heading): ?>

<div {{ $attributes->class('block space-y-[2px]') }}>
    <div class="px-1 py-2">
        <div class="text-xs leading-none text-zinc-400">{{ $heading }}</div>
    </div>

    <div>
        {{ $slot }}
    </div>
</div>

<?php else: ?>

<div {{ $attributes->class('block space-y-[2px]') }}>
    {{ $slot }}
</div>

<?php endif; ?>


@auth
    @if (auth()->user()->role === \App\Enums\UserRole::ADMIN)
        <a href="{{ route('manage-books') }}"
           class="{{ request()->routeIs('manage-books')
               ? 'flex items-center py-2 text-sm font-medium rounded-md text-white bg-white/10'
               : 'flex items-center py-2 text-sm font-medium rounded-md text-gray-300 hover:text-white hover:bg-white/10 hover:brightness-110 transition-all duration-200' }}">
           
           <span class="flex items-center ps-3">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2">
                   <path stroke-linecap="round" stroke-linejoin="round"
                         d="M12 6v12m6-6H6" />
               </svg>
               Manage Books
           </span>
        </a>
    @endif
@endauth

@auth
    @if (Auth::user()->role === \App\Enums\UserRole::USER)
        <a href="{{ route('borrow.books') }}"
           class="{{ request()->routeIs('borrow.books')
               ? 'flex items-center py-2 text-sm font-medium rounded-md text-white bg-white/10'
               : 'flex items-center py-2 text-sm font-medium rounded-md text-gray-300 hover:text-white hover:bg-white/10 hover:brightness-110 transition-all duration-200' }}">
            
            <span class="flex items-center ps-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6v12m6-6H6" />
                </svg>
                Borrow Books
            </span>
        </a>
    @endif
@endauth

@auth
    @if (Auth::user()->role === \App\Enums\UserRole::USER)
        <a href="{{ route('borrowed.books') }}"
           class="{{ request()->routeIs('borrowed.books')
               ? 'flex items-center py-2 text-sm font-medium rounded-md text-white bg-white/10'
               : 'flex items-center py-2 text-sm font-medium rounded-md text-gray-300 hover:text-white hover:bg-white/10 hover:brightness-110 transition-all duration-200' }}">
            
            <span class="flex items-center ps-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.5 19.5l15-15m-15 0h15v15" />
                </svg>
                Return Books
            </span>
        </a>
    @endif
@endauth
