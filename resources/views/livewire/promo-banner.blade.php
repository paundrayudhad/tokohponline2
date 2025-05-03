<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-extrabold text-center text-gray-900 mb-12 animate-fade-in-down tracking-tight">
        Apa Rencanamu Hari Ini? 🤔
    </h1>

    <!-- Tampilan Desktop (grid 2 kolom) -->
    <div class="hidden md:grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Kolom Kiri -->
        <div
            class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-transform transform hover:scale-[1.03] animate-fade-in-left group">
            <!-- Konten desktop sama seperti sebelumnya -->
            <div class="bg-blue-600 py-5 px-6 flex flex-col items-center text-center space-y-3">
                <h2 class="text-xl font-bold text-white group-hover:scale-105 transition">
                    HP Baru di Moora Phone Cell
                </h2>
            </div>
            <div class="p-6">
                <div class="mb-4 rounded-xl overflow-hidden">
                    <img src="{{ asset('img/Syihab-Silhouette-Web.png') }}" alt="HP Terbaru"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                </div>
                <p class="text-gray-600 mb-6 text-center text-lg">Promo Gila-gilaan, Jangan Lewatkan!</p>
                <div class="flex justify-center">
                    <button wire:click="lihatProduk"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full transition flex items-center space-x-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Lihat Produk</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div
            class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-transform transform hover:scale-[1.03] animate-fade-in-right group">
            <div class="bg-green-600 py-5 px-6 flex flex-col items-center text-center space-y-3">
                <h2 class="text-xl font-bold text-white group-hover:scale-105 transition">
                    Tukar Tambah di GSK
                </h2>
            </div>
            <div class="p-6">
                <div class="mb-4 rounded-xl overflow-hidden">
                    <img src="{{ asset('img/GSK-Silhouette-Web.png') }}" alt="Tukar Tambah"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                </div>
                <p class="text-gray-600 mb-6 text-center text-lg">Upgrade HP-mu Sekarang, Mumpung Masih Tinggi!</p>
                <div class="flex justify-center">
                    <button wire:click="tukarSekarang"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-full transition flex items-center space-x-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <span>Tukar Sekarang</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilan Mobile (satu row dua kolom) -->
    <div class="md:hidden grid grid-cols-2 gap-4">
        <!-- Item 1 -->
        <div class="bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center text-center">
            <h3 class="text-sm font-semibold text-gray-900">Cari HP Baru di Moora Phone Cell</h3>
            <img src="{{ asset('img/Syihab-Silhouette-Web.png') }}" alt="HP Baru" class="w-16 h-8 mb-3">
            <button wire:click="lihatProduk"
                class="mt-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full text-xs">
                Lihat Produk
            </button>
        </div>

        <!-- Item 2 -->
        <div class="bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center text-center">
            <h3 class="text-sm font-semibold text-gray-900">Tukar Tambah di GSK</h3>
            <img src="{{ asset('img/GSK-Silhouette-Mobile.png') }}" alt="Tukar Tambah" class="w-18 h-12 mb-3">
            <button wire:click="tukarSekarang"
                class="mt-3 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-full text-xs">
                Tukar Sekarang
            </button>
        </div>
    </div>

    <!-- CSS Animasi (tetap sama) -->
    <style>
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.7s ease-out forwards;
        }

        .animate-fade-in-left {
            animation: fadeInLeft 0.7s ease-out forwards;
        }

        .animate-fade-in-right {
            animation: fadeInRight 0.7s ease-out forwards;
        }
    </style>
</div>
