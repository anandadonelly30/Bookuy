<header class="bg-card-bg shadow-sm py-4 px-6 flex items-center justify-between">
    <div class="flex items-center">
        @isset($backButton)
            <a href="{{ $backButton }}" class="text-white-text mr-4">
                {{-- Icon panah kiri, bisa pakai SVG atau font icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
        @endisset
        <h1 class="text-xl font-bold text-white-text">{{ $title }}</h1>
    </div>
    @isset($rightContent)
        <div>
            {{ $rightContent }}
        </div>
    @endisset
</header>