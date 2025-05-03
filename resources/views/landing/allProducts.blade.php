<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .product-image-container {
            height: 192px;
            /* 12rem (48px * 4) */
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f3f4f6;
            /* bg-gray-100 */
        }

        .product-image {
            object-fit: contain;
            width: 100%;
            height: 100%;
            max-height: 100%;
            max-width: 100%;
        }

        /* Ensure the button stays at the bottom */
        .product-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-content {
            flex-grow: 1;
        }
    </style>
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navigation -->
    <livewire:navigation />

    <!-- Header -->
    <div class="text-center py-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Semua Produk</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Temukan berbagai produk unggulan yang tersedia di Moora Phone Cell
        </p>
    </div>

    <!-- Produk Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div
                    class="bg-white rounded-lg shadow hover:shadow-md transition p-4 flex flex-col product-card relative">
                    <!-- Badge Pre-Order (Conditional) -->
                    @if (empty($product->variations))
                        <div class="absolute top-2 right-2 z-10">
                            <div
                                class="bg-purple-100 w-14 h-14 rounded-full flex items-center justify-center relative drop-shadow-lg">
                                <img src="{{ asset('img/pre-order.png') }}" alt="Pre Order" class="w-5 h-5">
                            </div>
                        </div>
                    @endif

                    <div class="product-image-container mb-3 rounded-md relative">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="product-image">
                    </div>

                    <!-- Badge Text Pre-Order -->
                    @if (empty($product->variations))
                        <div class="mb-2">
                            <span
                                class="inline-flex items-center gap-1 bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Pre-Order
                            </span>
                        </div>
                    @endif

                    <!-- Konten produk lainnya tetap sama -->
                    <h2 class="text-lg font-semibold mb-1">{{ $product->name }}</h2>

                    @if (is_array($product->variations) && !empty($product->variations))
                        <ul class="text-sm text-gray-700 space-y-1 mb-2">
                            @foreach ($product->variations as $variant)
                                <li>
                                    {{ $variant['ram'] }}GB/{{ $variant['storage'] }}GB:
                                    <span class="font-medium text-green-600">
                                        Rp {{ number_format($variant['price'], 0, ',', '.') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Tombol tetap sama -->
                    <a href="{{ route('product-detail', $product->slug) }}"
                        class="mt-2 inline-block text-blue-600 hover:text-blue-800 font-medium">
                        Lihat Detail
                    </a>

                    <div class="product-content"></div>

                    @if (!empty($product->variations))
                        <a href="https://wa.me/628115546464?text={{ urlencode('Halo admin, saya ingin memesan ' . $product->name) }}"
                            target="_blank" data-product-name="{{ $product->name }}"
                            class="whatsapp-btn block text-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md mt-4">
                            Pesan Sekarang
                        </a>
                    @else
                        <a href="https://wa.me/628115546464?text={{ urlencode('Halo admin, saya ingin Pre-Order ' . $product->name) }}"
                            target="_blank" data-product-name="{{ $product->name }}"
                            class="whatsapp-btn block text-center bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md mt-4">
                            Pre-Order
                        </a>
                    @endif
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">Tidak ada produk yang tersedia.</p>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <livewire:footer />

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
                                cta_name: "Semua Product - " + productName
                            })
                        })
                        .then(response => response.json())
                        .then(data => console.log("CTA Tracked:", data))
                        .catch(error => console.error("Error:", error));
                });
            });
        });
    </script>
    @livewireScripts
</body>

</html>
