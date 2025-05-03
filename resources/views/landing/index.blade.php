<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navigation -->
    <livewire:navigation />

    <!-- Banner -->
    <x-banner-carousel />

    <!-- member card -->
    <livewire:member-card />

    <!-- Promo Banner -->
    <livewire:promo-banner />


    <!-- Daily Promo -->
    <livewire:components.daily-promo />

    <!-- brand slide -->
    <livewire:slide-brand />

    <!-- Event and Credit -->
    <livewire:event-and-credit />

    <!-- Keuntungan Belanja di Syihab Store -->
    <livewire:keuntung-belanja />


    <!-- Tentang Kami -->
    <livewire:about-us />


    <!-- Footer -->
    <livewire:footer />


    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
