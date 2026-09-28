@props([
    'href' => '#',
    'active' => false,
    'label' => '',
    'badge' => null,
    'icon' => null
])

<a href="{{ $href }}" 
   {{ $attributes->merge([
       'class' => 'group flex items-center rounded-xl text-xs font-medium transition-all duration-150 relative cursor-pointer ' . 
                  ($active 
                      ? 'bg-blue-50/90 text-blue-700 font-semibold shadow-xs' 
                      : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900')
   ]) }}
   :class="isCollapsed ? 'justify-center p-2' : 'gap-3 px-3 py-2.5'"
   x-bind:title="isCollapsed ? '{{ $label }}' : ''">
    
    @if ($active)
        <span class="absolute left-0 top-2 bottom-2 w-1 bg-blue-600 rounded-r-full transition-all duration-150"></span>
    @endif

    <div class="rounded-lg transition-colors duration-150 shrink-0 flex items-center justify-center {{ $active ? 'bg-blue-600 text-white shadow-xs' : 'text-slate-500 group-hover:text-slate-800 bg-slate-100/60' }}"
         :class="isCollapsed ? 'p-2' : 'p-1.5'">
        @if ($icon)
            {!! $icon !!}
        @else
            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="{{ $active ? 2.2 : 1.8 }}" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        @endif
    </div>

    <span x-show="!isCollapsed" 
          x-transition:enter="transition ease-out duration-150"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          class="truncate flex-1 {{ $active ? 'font-semibold text-blue-700' : 'text-slate-600 group-hover:text-slate-900 font-medium' }}">
        {{ $label }}
    </span>

    @if ($badge)
        <span x-show="!isCollapsed" 
              class="text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-gradient-to-r from-purple-500 to-indigo-500 text-white shrink-0 shadow-2xs">
            {{ $badge }}
        </span>
        <span x-show="isCollapsed" 
              class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-purple-500 ring-2 ring-white">
        </span>
    @endif
</a>
