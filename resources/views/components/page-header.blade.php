@props(['title', 'subtitle' => null, 'gradient' => true])

<div class="{{ $gradient ? 'bg-gradient-to-r from-primary/10 to-secondary/10' : 'bg-base-200' }} py-12 mb-8">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold mb-3" data-aos="fade-up">
                {{ $title }}
            </h1>
            @if($subtitle)
                <p class="text-lg text-base-content/70" data-aos="fade-up" data-aos-delay="100">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
    </div>
</div>
