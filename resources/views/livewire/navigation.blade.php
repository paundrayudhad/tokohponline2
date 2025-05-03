<nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ isMobileSearchOpen: false, isMobileMenuOpen: false }">
    <!-- Desktop Version -->
    <div class="hidden md:block">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/"
                        class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition-colors duration-200">
                        Moora Phone Celly
                    </a>
                </div>

                <!-- Search -->
                <div class="relative w-1/3">
                    <div class="relative">
                        <input wire:model.live.500ms.debounce.500ms="search" type="text"
                            placeholder="Cari produk atau brand..."
                            class="w-full px-4 py-2.5 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                            wire:focus="showDropdown = true" wire:keydown.escape="showDropdown = false">
                        <div wire:loading class="absolute right-3 top-2.5">
                            <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    @if ($showDropdown && strlen($search) >= 2)
                        <div
                            class="absolute z-20 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden">
                            <!-- Product Results -->
                            @if ($productResults->isNotEmpty())
                                <div class="px-4 py-2 bg-gray-50 border-b">
                                    <p class="text-xs font-semibold text-gray-600 tracking-wider">PRODUK</p>
                                </div>
                                @foreach ($productResults as $product)
                                    <button wire:click="selectProduct('{{ $product->slug }}')"
                                        class="block w-full text-left px-4 py-3 hover:bg-blue-50 transition-colors duration-150">
                                        <div class="flex items-center space-x-3">
                                            @if ($product->image)
                                                <div
                                                    class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}"
                                                        class="max-w-full max-h-full object-contain p-1" loading="lazy">
                                                </div>
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <p class="font-medium text-gray-900 truncate">{{ $product->name }}</p>
                                                @if ($product->price)
                                                    <p class="text-sm text-blue-600 font-medium mt-0.5">Rp
                                                        {{ number_format($product->price) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            @endif

                            <!-- Brand Results -->
                            @if ($brandResults->isNotEmpty())
                                <div class="px-4 py-2 bg-gray-50 border-b">
                                    <p class="text-xs font-semibold text-gray-600 tracking-wider">BRAND</p>
                                </div>
                                @foreach ($brandResults as $brand)
                                    <a href="{{ route('brand-detail', ['slug' => $brand->slug]) }}"
                                        class="block w-full text-left px-4 py-3 hover:bg-blue-50 transition-colors duration-150">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                @if ($brand->logo)
                                                    <div
                                                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center overflow-hidden border border-gray-200">
                                                        <img src="{{ asset('storage/' . $brand->logo) }}"
                                                            alt="{{ $brand->name }}"
                                                            class="max-w-full max-h-full object-contain p-1"
                                                            loading="lazy">
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-50 to-gray-100 flex items-center justify-center">
                                                        <span
                                                            class="text-sm font-medium text-gray-600">{{ substr($brand->name, 0, 2) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-medium text-gray-900 truncate">{{ $brand->name }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5">
                                                    {{ $brand->products_count ?? 0 }} produk tersedia</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif

                            <!-- Empty State -->
                            @if ($productResults->isEmpty() && $brandResults->isEmpty())
                                <div class="px-4 py-4 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Tidak ditemukan hasil untuk <span
                                            class="font-medium">"{{ $search }}"</span></p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('products') }}"
                        class="text-gray-800 hover:text-blue-600 transition-colors duration-200 font-medium">Produk</a>
                    <a href="#"
                        class="text-gray-800 hover:text-blue-600 transition-colors duration-200 font-medium">Promo</a>
                    <!-- Price List with dropdown -->
                    <div class="relative group">
                        <a href="#"
                            class="text-gray-800 hover:text-blue-600 transition-colors duration-200 font-medium inline-flex items-center">
                            Price List
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <ul class="absolute hidden group-hover:block bg-white shadow-lg mt-2 py-2 rounded-md w-48">
                            @foreach ($brands as $brand)
                                <li>
                                    <a href="{{ route('price-list', $brand->slug) }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        {{ $brand->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="#"
                        class="text-gray-800 hover:text-blue-600 transition-colors duration-200 font-medium">Tentang
                        Kami</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Version -->
    <div class="md:hidden fixed top-0 left-0 right-0 bg-white shadow z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo Mobile -->
                <a href="/" class="text-xl font-bold text-gray-800">Syihab Store</a>

                <!-- Mobile Icons -->
                <div class="flex items-center space-x-4">
                    <!-- Search Toggle -->
                    <button @click="isMobileSearchOpen = !isMobileSearchOpen; isMobileMenuOpen = false"
                        class="p-2 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Menu Toggle -->
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen; isMobileSearchOpen = false"
                        class="p-2 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Search Panel -->
        <div x-show="isMobileSearchOpen" x-transition class="absolute top-16 left-0 right-0 bg-white border-t z-40">
            <div class="container mx-auto px-4 py-3">
                <div class="relative">
                    <input wire:model.live.500ms.debounce.500ms="search" type="text"
                        placeholder="Cari produk/brand..."
                        class="w-full px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        wire:focus="showDropdown = true">
                    <div wire:loading class="absolute right-3 top-2.5">
                        <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Mobile Search Results -->
                @if ($showDropdown && strlen($search) >= 2)
                    <div class="mt-2 max-h-[60vh] overflow-y-auto">
                        @if ($productResults->isNotEmpty())
                            <div class="px-4 py-2 bg-gray-50">
                                <p class="text-xs font-semibold text-gray-600">PRODUK</p>
                            </div>
                            @foreach ($productResults as $product)
                                <a href="{{ route('product-detail', ['slug' => $product->slug]) }}"
                                    class="block w-full text-left px-4 py-3 border-b hover:bg-blue-50">
                                    <div class="flex items-center space-x-3">
                                        @if ($product->image)
                                            <div
                                                class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    class="max-w-full max-h-full object-contain p-1">
                                            </div>
                                        @else
                                            <div
                                                class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium">{{ $product->name }}</p>
                                            @if ($product->price)
                                                <p class="text-sm text-blue-600">Rp
                                                    {{ number_format($product->price) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        @if ($brandResults->isNotEmpty())
                            <div class="px-4 py-2 bg-gray-50">
                                <p class="text-xs font-semibold text-gray-600">BRAND</p>
                            </div>
                            @foreach ($brandResults as $brand)
                                <a href="{{ route('brand-detail', ['slug' => $brand->slug]) }}"
                                    class="block w-full text-left px-4 py-3 border-b hover:bg-blue-50">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            @if ($brand->logo)
                                                <div
                                                    class="w-14 h-14 bg-white rounded-full flex items-center justify-center overflow-hidden border border-gray-200">
                                                    <img src="{{ asset('storage/' . $brand->logo) }}"
                                                        class="max-w-full max-h-full object-contain p-1">
                                                </div>
                                            @else
                                                <div
                                                    class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-50 to-gray-100 flex items-center justify-center">
                                                    <span
                                                        class="text-sm font-medium text-gray-600">{{ substr($brand->name, 0, 2) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $brand->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $brand->products_count ?? 0 }} produk
                                                tersedia</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="isMobileMenuOpen" x-transition class="absolute top-16 left-0 right-0 bg-white border-t z-40">
            <div class="container mx-auto px-4 py-2">
                <a href="{{ route('products') }}" class="block py-3 border-b text-gray-800">Produk</a>
                <a href="#" class="block py-3 border-b text-gray-800">Promo</a>

                <!-- Price List dengan dropdown mobile -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full text-left py-3 border-b text-gray-800 flex items-center justify-between">
                        Price List
                        <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition>
                        @foreach ($brands as $brand)
                            <a href="{{ route('price-list', $brand->slug) }}"
                                class="block pl-6 pr-4 py-2 text-gray-700 hover:bg-gray-100">
                                {{ $brand->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="#" class="block py-3 text-gray-800">Tentang Kami</a>
            </div>
        </div>

    </div>

    <!-- Spacer untuk konten di bawah fixed mobile header -->
    <div class="md:hidden h-16"></div>
</nav>
