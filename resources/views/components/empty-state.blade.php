@props(['message' => 'Tidak ada data tersedia', 'icon' => null])

<div class="flex flex-col items-center justify-center py-16 px-4 text-center" data-aos="fade-up">
    <div class="w-24 h-24 mb-6 text-base-content/20">
        @if($icon)
            {!! $icon !!}
        @else
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @endif
    </div>
    <p class="text-base-content/60 text-lg font-medium">{{ $message }}</p>
</div>
