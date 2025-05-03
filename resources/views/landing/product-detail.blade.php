<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Navigation -->
    <livewire:navigation />

    <div class="container mx-auto px-3 py-4 max-w-7xl mt-5">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-center text-gray-900 mb-6 sm:mb-8 tracking-tight">
            DETAIL PRODUCT {{ $product->name }}
        </h1>

        <div class="container mx-auto px-3 py-6 max-w-7xl">
            <div class="grid md:grid-cols-2 gap-10 bg-white rounded-xl shadow-md p-6">
                <!-- Gambar Produk -->
                <div class="flex justify-center items-center relative">
                    @if (empty($product->variations))
                        <div class="absolute top-2 right-2 z-10">
                            <div
                                class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center relative drop-shadow-lg">
                                <img src="{{ asset('img/pre-order.png') }}" alt="Pre Order" class="w-10 h-10">
                            </div>
                        </div>
                    @endif
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="rounded-lg w-full max-w-md object-contain shadow-sm">
                </div>

                <!-- Detail Produk -->
                <div class="space-y-5">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h2>

                    <!-- Variasi Produk -->
                    @if (is_array($product->variations) && count($product->variations))
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Pilih Varian:</p>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($product->variations as $key => $variation)
                                    <button
                                        onclick="selectVariant('{{ $key }}', {{ json_encode($variation) }})"
                                        class="variant-btn border px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 active
                                               {{ $loop->first ? 'bg-blue-100 border-blue-300' : 'border-gray-300' }}"
                                        data-key="{{ $key }}">
                                        {{ $variation['ram'] ?? '' }} GB / {{ $variation['storage'] ?? '' }} GB
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Harga -->
                    <div id="priceDisplay" class="mb-6 p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Harga:</p>
                        <span id="priceValue" class="text-3xl font-bold text-blue-600">
                            @if (is_array($product->variations) && count($product->variations))
                                Rp
                                {{ number_format($product->variations[array_key_first($product->variations)]['price'], 0, ',', '.') }}
                            @else
                                PRE ORDER
                            @endif
                        </span>
                    </div>

                    <!-- Spesifikasi -->
                    @if (is_array($product->specs))
                        <div class="space-y-4 mt-6">
                            <h3 class="text-lg font-semibold text-gray-700">Spesifikasi Lengkap</h3>
                            <div
                                class="grid sm:grid-cols-2 gap-4 text-sm text-gray-800 bg-gray-50 p-4 rounded-lg shadow-inner">
                                @php
                                    $specList = [
                                        'os' => 'Sistem Operasi',
                                        'weight' => 'Berat (gram)',
                                        'battery' => 'Baterai (mAh)',
                                        'chipset' => 'Chipset',
                                        'display' => 'Ukuran Layar (inci)',
                                        'resolution' => 'Resolusi Layar',
                                        'main_camera' => 'Kamera Utama (MP)',
                                        'front_camera' => 'Kamera Depan (MP)',
                                        'refresh_rate' => 'Refresh Rate (Hz)',
                                    ];
                                @endphp

                                @foreach ($specList as $key => $label)
                                    @if (!empty($product->specs[$key]))
                                        <div class="flex justify-between border-b pb-1">
                                            <span class="text-gray-500">{{ $label }}</span>
                                            <span class="font-medium">{{ $product->specs[$key] }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tombol WhatsApp -->
                    <a id="whatsappButton"
                        href="https://wa.me/628115546464?text={{ urlencode('Halo admin call center Moora Phone Cell, saya tertarik dengan produk ' . $product->name . (is_array($product->variations) && count($product->variations) ? ' varian ' . $product->variations[array_key_first($product->variations)]['ram'] . ' GB / ' . $product->variations[array_key_first($product->variations)]['storage'] . ' GB' : '')) }}"
                        target="_blank" data-product-name="{{ $product->name }}"
                        class="whatsapp-btn block text-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md">
                        🛒 Pesan Sekarang via WhatsApp
                    </a>

                </div>
            </div>

            <!-- Galeri Produk -->
            @if (is_array($product->gallery) && count($product->gallery))
                <div class="mt-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Galeri Produk</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($product->gallery as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image"
                                class="w-full h-auto rounded-lg shadow hover:shadow-lg transition duration-300">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Script: Pilih Varian -->
    <script>
        function selectVariant(key, variant) {
            const priceValue = document.getElementById('priceValue');
            priceValue.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(variant.price)}`;

            document.querySelectorAll('.variant-btn').forEach(btn => {
                btn.classList.remove('bg-blue-100', 'border-blue-300');
                if (btn.dataset.key === key) {
                    btn.classList.add('bg-blue-100', 'border-blue-300');
                }
            });

            const productName = "{{ $product->name }}";
            const variantText = `${variant.ram} GB / ${variant.storage} GB`;
            const whatsappMessage =
                `Halo admin call center Moora Phone Cell, saya tertarik dengan produk ${productName} varian ${variantText}`;
            const encodedMessage = encodeURIComponent(whatsappMessage);

            document.getElementById('whatsappButton').href = `https://wa.me/628115546464?text=${encodedMessage}`;
        }
    </script>

    <!-- Script: Track CTA -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.whatsapp-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const productName = this.dataset.productName;

                    fetch("{{ url('/track-click') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                page: document.title,
                                cta_name: "Product Detail - " + productName
                            })
                        })
                        .then(response => response.json())
                        .then(data => console.log("CTA Tracked:", data))
                        .catch(error => console.error("Error:", error));
                });
            });
        });
    </script>

    <!-- Tentang Kami -->
    <livewire:about-us />

    <!-- Footer -->
    <livewire:footer />

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
