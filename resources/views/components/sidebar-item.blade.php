@props([
    'href' => '#',
    'active' => false,
    'label' => '',
    'badge' => null,
    'icon' => null
])

@php
    $baseClasses = 'relative group flex items-center gap-x-3 px-3 py-2 text-xs sm:text-sm rounded-2xl transition-all duration-200 ease-out overflow-hidden active:scale-[0.98] active:bg-[#eff6ff] active:text-[#2563eb] cursor-pointer';
    
    $activeClasses = $active 
        ? 'bg-[#eff6ff] text-[#2563eb] font-bold shadow-xs' 
        : 'text-slate-500 font-medium hover:text-slate-700 hover:bg-slate-50/80';
        
    $iconContainerClasses = $active
        ? 'bg-[#2563eb] text-white shadow-xs scale-100'
        : 'bg-[#f1f5f9] text-slate-400 group-hover:text-slate-600 group-active:bg-[#2563eb] group-active:text-white transition-all duration-200';
@endphp

<a href="{{ $href }}" 
   {{ $attributes->merge(['class' => "{$baseClasses} {$activeClasses}"]) }}
   x-bind:title="isCollapsed ? '{{ $label }}' : ''">
    
    @if ($active)
        <span class="w-1.5 h-6 bg-[#2563eb] rounded-r-md absolute left-0 top-1/2 -translate-y-1/2 transition-all duration-300"></span>
    @endif

    <div class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-xl transition-all duration-200 {{ $iconContainerClasses }}">
        @if ($icon)
            {!! $icon !!}
        @else
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        @endif
    </div>

    <span x-show="!isCollapsed" 
          x-transition:enter="transition ease-out duration-150"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          class="truncate flex-1 text-xs sm:text-sm tracking-tight {{ $active ? 'font-bold text-[#2563eb]' : 'font-medium text-slate-500 group-hover:text-slate-700 group-active:text-[#2563eb]' }} transition-colors duration-200">
        {{ $label }}
    </span>

    @if ($badge)
        <span x-show="!isCollapsed" 
              class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold {{ $active ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-500' }}">
            {{ $badge }}
        </span>
    @endif
</a>
