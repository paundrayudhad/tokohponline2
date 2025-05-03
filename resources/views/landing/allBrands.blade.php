<!DOCTYPE html>
<html lang="id">

<head>
    {!! SEO::generate() !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .brand-image-container {
            height: 192px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #ffffff;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .brand-image {
            object-fit: contain;
            width: 100%;
            height: 100%;
            max-height: 100%;
            max-width: 100%;
            transition: transform 0.3s ease;
        }

        .brand-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .brand-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .brand-card:hover .brand-image {
            transform: scale(1.05);
        }

        .brand-content {
            flex-grow: 1;
            padding: 1rem;
        }

        .pagination .page-item.active .page-link {
            background-color: #2563eb;
            border-color: #2563eb;
            color: white;
        }

        .pagination .page-link {
            color: #2563eb;
        }
    </style>
    @livewireStyles
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Navigation -->
    <livewire:navigation />

    <div class="text-center py-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Semua Brand</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Temukan berbagai brand unggulan yang tersedia di Moora Phone Cell
        </p>
    </div>

    <!-- Brand Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($brands->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach ($brands as $brand)
                    <a href="{{ route('brand-detail', $brand->slug) }}" class="group">
                        <div class="rounded-lg shadow-sm overflow-hidden brand-card h-full">
                            <div class="brand-image-container">
                                @if ($brand->logo)
                                    <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}"
                                        class="brand-image" loading="lazy">
                                @else
                                    <div class="text-gray-400 flex flex-col items-center">
                                        <i class="fas fa-image text-4xl mb-2"></i>
                                        <span class="text-sm">Tidak ada logo</span>
                                    </div>
                                @endif
                            </div>
                            <div class="brand-content text-center p-4">
                                <h3
                                    class="font-semibold text-lg text-gray-800 group-hover:text-blue-600 transition-colors">
                                    {{ $brand->name }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $brand->products_count }} produk</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <div class="mx-auto w-24 h-24 text-gray-400 mb-4">
                    <i class="fas fa-box-open text-6xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700 mb-2">Belum ada brand yang tersedia</h3>
                <p class="text-gray-500 mb-4">Kami akan segera menambahkan brand-brand terbaik untuk Anda</p>
                <a href="{{ route('landing') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <livewire:footer />

    @livewireScripts
</body>

</html>
