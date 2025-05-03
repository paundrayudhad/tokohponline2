@php
    $selectedPricelist = $pricelists->firstWhere('slug', $slug);
@endphp

<div class="priceless-slider-component">
    <div class="priceless-banner-container">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-6 tracking-tight animate-fade-in-down">
                DAFTAR HARGA {{ $selectedPricelist->list ?? 'Default List' }} Moora Phone Cell
            </h1>
        </div>

        <!-- Swiper Slider -->
        <div class="swiper priceless-swiper">
            <div class="swiper-wrapper">
                @foreach ($selectedPricelist->picture ?? [] as $pic)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $pic['image']) }}" alt="Image" class="w-full rounded shadow">
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination priceless-pagination"></div>
        </div>

        <!-- CTA Button -->
        <div class="text-center mt-10">
            <button id="openPricelessModal"
                class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold shadow hover:bg-green-700 transition">
                Hubungi Call Center
            </button>
        </div>

        <!-- Modal Form -->
        <div id="pricelessModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <button id="closePricelessModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl font-bold">&times;</button>
                <h2 class="text-xl font-bold mb-4 text-center">
                    Tanya-tanya {{ $selectedPricelist->list ?? 'Default List' }}
                </h2>
                <form id="pricelessForm">
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Nama</label>
                        <input type="text" name="nama" required class="w-full border rounded px-3 py-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Jenis Kelamin</label>
                        <select name="gender" required class="w-full border rounded px-3 py-2">
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Umur</label>
                        <input type="number" name="umur" required class="w-full border rounded px-3 py-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Nomor WhatsApp</label>
                        <input type="text" name="nowa" required placeholder="Contoh: 08123456789"
                            class="w-full border rounded px-3 py-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Alamat Lengkap</label>
                        <textarea name="alamat" required class="w-full border rounded px-3 py-2" rows="3"></textarea>
                    </div>
                    <button type="submit"
                        class="bg-green-600 text-white w-full py-2 rounded font-semibold hover:bg-green-700 transition">
                        Kirim ke WhatsApp
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .priceless-banner-container {
            max-width: 1080px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .priceless-swiper {
            width: 100%;
            max-width: 1080px;
            margin: 0 auto;
        }

        .priceless-pagination {
            position: relative;
            margin-top: 1rem;
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const pricelistName = @json($selectedPricelist->list ?? 'Default List');

                new Swiper('.priceless-swiper', {
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false
                    },
                    loop: true,
                    pagination: {
                        el: '.priceless-pagination',
                        clickable: true,
                    },
                    slidesPerView: 1,
                    spaceBetween: 30,
                    centeredSlides: true,
                    speed: 600,
                });

                document.getElementById('openPricelessModal').addEventListener('click', () => {
                    document.getElementById('pricelessModal').classList.remove('hidden');
                    document.getElementById('pricelessModal').classList.add('flex');
                });

                document.getElementById('closePricelessModal').addEventListener('click', () => {
                    document.getElementById('pricelessModal').classList.add('hidden');
                });

                document.getElementById('pricelessForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const nama = this.nama.value;
                    const gender = this.gender.value;
                    const umur = this.umur.value;
                    const nowa = this.nowa.value;
                    const alamat = this.alamat.value;

                    const message =
                        `Halo admin Moora Phone Cell, saya tertarik dengan ${pricelistName}:\n\n` +
                        `Nama: ${nama}\nJenis Kelamin: ${gender}\nUmur: ${umur}\nNo WA: ${nowa}\nAlamat: ${alamat}`;

                    const waNumber = "628115546464";
                    const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`;
                    window.open(waUrl, '_blank');
                });
            });
        </script>
    @endpush
</div>
