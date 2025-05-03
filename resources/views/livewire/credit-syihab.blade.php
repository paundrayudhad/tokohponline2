<div class="credit-slider-component">
    <div class="credit-banner-container">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-6 tracking-tight animate-fade-in-down">
                Simulasi Kredit Moora Phone Cell
            </h1>
        </div>

        <!-- Swiper Slider -->
        <div class="swiper credit-swiper">
            <div class="swiper-wrapper">
                @foreach ($credits as $credit)
                    <div class="swiper-slide">
                        <div class="credit-image-container">
                            <img src="{{ Storage::url($credit->image) }}" alt="Credit Image" class="credit-image"
                                loading="lazy">
                        </div>
                    </div>
                @endforeach
            </div>

            @if (count($credits) > 1)
                <div class="swiper-pagination credit-pagination"></div>
            @endif
        </div>

        <!-- CTA Button -->
        <div class="text-center mt-10">
            <button id="openCtaModal"
                class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold shadow hover:bg-green-700 transition">
                Ajukan Kredit Sekarang
            </button>
        </div>

        <!-- Modal Form -->
        <div id="ctaModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <button id="closeCtaModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl font-bold">
                    &times;
                </button>
                <h2 class="text-xl font-bold mb-4 text-center">Form Pengajuan Kredit</h2>
                <form id="whatsappForm">
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
        .credit-banner-container {
            max-width: 1080px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .credit-swiper {
            width: 100%;
            max-width: 1080px;
            margin: 0 auto;
        }

        .credit-image-container {
            position: relative;
            width: 100%;
            padding-bottom: 125%;
            /* 4:5 Aspect Ratio */
            overflow: hidden;
            background: #f5f5f5;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .credit-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .credit-pagination {
            position: relative;
            margin-top: 1rem;
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Swiper init
                new Swiper('.credit-swiper', {
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    loop: true,
                    pagination: {
                        el: '.credit-pagination',
                        clickable: true,
                    },
                    slidesPerView: 1,
                    spaceBetween: 30,
                    centeredSlides: true,
                    speed: 600,
                });
            });
        </script>
        <script>
            // Buka modal
            document.getElementById('openCtaModal').addEventListener('click', () => {
                document.getElementById('ctaModal').classList.remove('hidden');
                document.getElementById('ctaModal').classList.add('flex');
            });

            // Tutup modal
            document.getElementById('closeCtaModal').addEventListener('click', () => {
                document.getElementById('ctaModal').classList.add('hidden');
            });

            // Kirim ke WhatsApp
            document.getElementById('whatsappForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const nama = this.nama.value;
                const gender = this.gender.value;
                const umur = this.umur.value;
                const nowa = this.nowa.value;
                const alamat = this.alamat.value;

                const message = `Halo admin call center Moora Phone Cell, saya ingin mengajukan kredit:\n\n` +
                    `Nama: ${nama}\n` +
                    `Jenis Kelamin: ${gender}\n` +
                    `Umur: ${umur} tahun\n` +
                    `Nomor WA: ${nowa}\n` +
                    `Alamat: ${alamat}`;

                const whatsappNumber = "628115546464";

                const url = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
                window.open(url, '_blank');
            });
        </script>
    @endpush
</div>
