<div class="container mx-auto px-4 py-4 max-w-7xl">
    <h1 class="text-4xl font-extrabold text-center text-gray-900 mb-12 animate-fade-in-down tracking-tight">
        BRAND PILIHAN KAMI
    </h1>
    <div id="brandSwiper" class="swiper">
        <div class="swiper-wrapper">
            @foreach ($brands as $brand)
                <a href="{{ route('brand-detail', $brand->slug) }}" class="swiper-slide flex justify-center items-center p-4 bg-white rounded-lg shadow">
                    <img src="{{ asset('storage/' . ($brand->logo ?? 'default-logo.png')) }}" alt="{{ $brand->name }}"
                        class="h-16 object-contain" />
                </a>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandCount = {{ $brands->count() }};
            new Swiper("#brandSwiper", {
                loop: brandCount > 4,
                loopedSlides: brandCount,
                slidesPerView: 2,
                spaceBetween: 16,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                // Navigation intentionally removed since it's not visible on mobile
                breakpoints: {
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 24,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 28,
                    },
                },
            });
        });
    </script>
@endpush
