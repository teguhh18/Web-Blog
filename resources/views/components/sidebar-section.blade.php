@props(['title' => null, 'icon' => null])

<div class="card bg-base-100 shadow-lg" data-aos="fade-left">
    <div class="card-body">
        @if($title)
            <div class="flex items-center gap-2 mb-4">
                @if($icon)
                    <div class="p-2 bg-primary/10 rounded-lg">
                        {!! $icon !!}
                    </div>
                @endif
                <h3 class="card-title text-lg font-bold">{{ $title }}</h3>
            </div>
        @endif
        <div class="space-y-4">
            {{ $slot }}
        </div>
    </div>
</div>
