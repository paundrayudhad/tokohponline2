<!DOCTYPE html>
<html lang="id">

<head>
    <title>Moora Phone Cell - Price List {{ $slug }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Daftar harga produk dan layanan kami. Dapatkan penawaran terbaik untuk kebutuhan Anda.">
    <meta name="keywords" content="harga, produk, layanan, penawaran, terbaik">
    <meta property="og:title" content="Moora Phone Cell - Price List {{ $slug }}">
    <meta property="og:description" content="Daftar harga produk dan layanan kami. Dapatkan penawaran terbaik untuk kebutuhan Anda.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <meta name="twitter:title" content="Moora Phone Cell - Price List {{ $slug }}">
    <meta name="twitter:description" content="Daftar harga produk dan layanan kami. Dapatkan penawaran terbaik untuk kebutuhan Anda.">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "Moora Phone Cell - Price List {{ $slug }}",
            "description": "Daftar harga produk dan layanan kami. Dapatkan penawaran terbaik untuk kebutuhan Anda.",
            "url": "{{ url()->current() }}"
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navigation -->
    <livewire:navigation />

    <!-- credit -->
    <livewire:price-list :slug="$slug"/>

    <!-- Tentang Kami -->
    <livewire:about-us />

    <!-- Footer -->
    <livewire:footer />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    @stack('scripts')

    @livewireScripts
</body>

</html>
