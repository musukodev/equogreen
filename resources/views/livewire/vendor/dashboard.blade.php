<main class="flex h-full min-w-0 flex-1 flex-col gap-6 overflow-y-auto p-6 lg:p-8">

    <!-- Top Header (If not provided by layout) -->
    <header class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <!-- Mobile Hamburger -->
            <button onclick="toggleSidebar()"
                class="hover:bg-primary hover:border-primary group flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white lg:hidden">
                <img src="/gambar/garis3.png" alt="Menu"
                    class="h-6 w-6 object-contain group-hover:brightness-0 group-hover:invert" />
            </button>
            <div>
                <h1 class="text-2xl font-bold text-[#111827] md:text-[36px]">Dashboard</h1>
                <p class="mt-0.5 text-xs text-gray-400 md:mt-1 md:text-base md:text-gray-500">Akses semua quotation
                    Anda dalam satu tempat</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="flex items-center gap-3" x-data="{ openNotifications: false }">
            <!-- Notification Bell -->
            <div class="relative">
               
                <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200 shadow-sm">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="w-6 h-6 object-contain" />
                    @if (count($notifications) > 0)
                        <span
                            class="absolute -right-1 -top-1 flex h-5 w-5 animate-pulse items-center justify-center rounded-full bg-red-500 text-[10px] font-extrabold text-white">
                            {{ count($notifications) }}
                        </span>
                    @endif
            </button>

                <!-- Dropdown List Notifikasi -->
                <div x-show="openNotifications" @click.away="openNotifications = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 z-50 mt-2 flex w-80 flex-col gap-3 rounded-2xl border border-gray-200 bg-white p-4 shadow-xl"
                    style="display: none;" x-cloak>
                    <h4 class="flex items-center justify-between border-b pb-2 text-sm font-bold text-gray-800">
                        <span>Notifikasi</span>
                        <span class="text-xs font-normal text-gray-400">Terbaru</span>
                    </h4>
                    <div class="flex max-h-60 flex-col gap-2.5 overflow-y-auto pr-1">
                        @forelse($notifications as $notif)
                            <div
                                class="flex flex-col gap-1 rounded-xl border border-gray-100 bg-gray-50 p-3 text-left transition duration-150 hover:bg-gray-100">
                                <p class="text-xs font-medium leading-relaxed text-gray-700">{{ $notif->isi }}</p>
                                <span
                                    class="self-end text-[9px] font-bold text-gray-400">{{ $notif->created_at ? $notif->created_at->diffForHumans() : '-' }}</span>
                            </div>
                        @empty
                            <div class="flex flex-col items-center gap-2 py-6 text-center">
                                <i class="ph ph-bell-slash text-2xl text-gray-300"></i>
                                <p class="text-xs font-medium text-gray-400">Tidak ada notifikasi baru</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Profile -->
            <img src="/gambar/profileup.png" alt="Profil"
                class="hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" />
            <div class="hidden h-10 w-px bg-gray-200 md:block"></div>
            <span
                class="hidden text-[17px] font-medium text-gray-700 md:block">{{ Auth::user()->vendor->nama_perusahaan ?? 'Vendor' }}</span>
        </div>
    </header>

    <!-- Summary Cards -->
    <div class="mb-4 mt-0 grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-5 lg:grid-cols-3">
        <!-- Card 1 -->
        <div
            class="group flex cursor-pointer items-center gap-4 rounded-2xl border border-gray-100 bg-white p-4 shadow-[0_2px_10px_rgba(0,0,0,0.04)] transition-all duration-300 hover:scale-[1.01] hover:shadow-md">
            <div
                class="flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#c5d5ca] text-gray-600 transition-transform group-hover:rotate-3">
                <i class="fa-solid fa-file-invoice text-2xl opacity-70"></i>
            </div>
            <div>
                <h3 class="mb-0.5 text-2xl font-extrabold leading-tight text-black">{{ count($groupedPenawarans) }}</h3>
                <p class="text-sm font-medium text-gray-500">Quotation aktif</p>
            </div>
        </div>
        <!-- Card 2 -->
        <div
            class="group flex cursor-pointer items-center gap-4 rounded-2xl border border-gray-100 bg-white p-4 shadow-[0_2px_10px_rgba(0,0,0,0.04)] transition-all duration-300 hover:scale-[1.01] hover:shadow-md">
            <div
                class="flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#fce5be] transition-transform group-hover:rotate-3">
                <i class="fa-solid fa-hourglass-half text-2xl text-[#d97706] opacity-70"></i>
            </div>
            <div>
                <h3 class="mb-0.5 text-2xl font-extrabold leading-tight text-black">0</h3>
                <p class="text-sm font-medium text-gray-500">Menunggu review</p>
            </div>
        </div>
        <!-- Card 3 -->
        <div
            class="group flex cursor-pointer items-center gap-5 rounded-2xl border border-gray-100 bg-white p-5 shadow-[0_2px_10px_rgba(0,0,0,0.04)] transition-all duration-300 hover:scale-[1.01] hover:shadow-md">
            <div
                class="flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f6b4b4] transition-transform group-hover:rotate-3">
                <i class="fa-solid fa-circle-check text-2xl text-[#dc2626] opacity-70"></i>
            </div>
            <div>
                <h3 class="mb-0.5 text-2xl font-extrabold leading-tight text-black">0</h3>
                <p class="text-sm font-medium text-gray-500">Selesai</p>
            </div>
        </div>
    </div>

    <!-- Pengumuman Card -->
    <div
        class="group relative mb-4 flex min-h-[140px] cursor-pointer items-center overflow-hidden rounded-2xl bg-[#4039c9] p-6 text-white shadow-lg transition-all duration-300 hover:scale-[1.01] hover:shadow-xl md:min-h-[160px] md:p-7 lg:p-8">
        <div class="relative z-10 w-full md:w-3/4">
            <p class="mb-2 text-[10px] font-black uppercase tracking-widest text-white/70 md:mb-3 md:text-[11px]">
                PENGUMUMAN</p>
            <h2 class="mb-3 text-lg font-bold leading-tight tracking-tight md:mb-4 md:text-2xl lg:text-[30px]">
                Ketuk untuk melihat
                Pengumuman<br class="hidden sm:block">Pengadaan Barang hari ini</h2>
            <p class="text-xs font-medium text-white/80 md:text-sm lg:text-base">Pastikan semua dokumen
                quotation telah
                dilengkapi sebelum batas waktu</p>
        </div>
        <!-- Decorative Circles -->
        <div
            class="absolute right-[-5%] top-[-10%] hidden h-64 w-64 rounded-full bg-white/5 mix-blend-overlay md:block">
        </div>
        <!-- Banner Icon Area -->
        <div
            class="absolute right-12 top-1/2 hidden h-24 w-24 -translate-y-1/2 transform items-center justify-center rounded-full bg-[#2d4ddd]/65 md:flex lg:right-20 lg:h-32 lg:w-32">
            <img src="/gambar/pengumuman.png" alt="Banner Icon" class="h-16 w-16 object-contain" />
        </div>
    </div>

    <!-- Daftar Quotation Header -->
    <div class="mb-3 mt-0">
        <div class="inline-flex items-center gap-3 rounded-xl bg-[#d7dfec] px-4 py-2.5 shadow-sm">
            <div class="flex h-8 w-8 items-center justify-center rounded-full border-[1.5px] border-black">
                <i class="fa-regular fa-file-lines text-sm text-black"></i>
            </div>
            <h2 class="pr-2 text-lg font-bold text-black">Daftar Quotation</h2>
        </div>
    </div>

    <!-- Quotation Grid -->
    <div class="grid grid-cols-1 gap-4 pb-20 sm:grid-cols-2 md:gap-5 lg:grid-cols-3">
        @forelse($groupedPenawarans as $groupId => $items)
            @php $batch = $items->first()->batch; @endphp
            <!-- Quotation Item -->
            <div
                class="flex cursor-pointer flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-[0_2px_10px_rgba(0,0,0,0.04)] transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-[1.01] hover:border-gray-300 hover:shadow-xl">

                @php
                    $colors = [
                        ['bg' => '#e4e9e5', 'icon' => '#609966', 'iconClass' => 'fa-pen-nib'],
                        ['bg' => '#fbf0dc', 'icon' => '#e5b83b', 'iconClass' => 'fa-couch'],
                        ['bg' => '#fbd4d4', 'icon' => '#ce3030', 'iconClass' => 'fa-mobile-screen'],
                        ['bg' => '#e0e7ff', 'icon' => '#4338ca', 'iconClass' => 'fa-box-open'],
                    ];
                    $theme = $colors[$loop->index % count($colors)];
                @endphp

                <div class="relative flex h-[120px] items-center justify-center overflow-hidden bg-[{{ $theme['bg'] }}]"
                    style="background-color: {{ $theme['bg'] }};">
                    <i class="fa-solid {{ $theme['iconClass'] }} text-[80px]" style="color: {{ $theme['icon'] }};"></i>
                </div>
                <div class="flex flex-grow flex-col p-5">
                    <h3 class="mb-3 mt-1 text-[15px] font-bold leading-tight tracking-tight text-black">
                        Pengadaan Barang
                    </h3>

                    <div class="mb-4 w-full rounded-md border border-[#ecd5a0] bg-[#faebca] p-2.5 shadow-sm">
                        <p class="mb-0.5 text-[9px] font-extrabold tracking-wider text-[#7a5712]">BATAS WAKTU</p>
                        <p class="text-xs font-bold text-[#7a5712]">
                            {{ \Carbon\Carbon::parse($batch->waktu_selesai)->translatedFormat('d F Y, H.i') }} WIB</p>
                    </div>

                    <p id="timer_{{ $groupId }}" class="mb-5 text-[11px] font-extrabold text-[#d71919]"></p>

                    <a href="{{ route('vendor-buat_quotation', $groupId) }}"
                        class="mt-auto block w-full rounded-lg bg-[#1e40ff] py-3 text-center text-sm font-bold text-white transition hover:bg-blue-700"
                        wire:navigate>
                        Buka Quotation
                    </a>
                </div>
            </div>
        @empty
            <div
                class="col-span-full mt-4 rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-500 shadow-sm">
                <i class="fa-regular fa-folder-open mb-3 text-4xl text-gray-300"></i>
                <p>Belum ada daftar quotation (pengadaan barang) yang tertuju pada Anda.</p>
            </div>
        @endforelse
    </div>

    @if (count($groupedPenawarans) > 0)
        <script>
            const timers = [
                @foreach ($groupedPenawarans as $groupId => $items)
                    @php $batch = $items->first()->batch; @endphp
                    {
                        id: 'timer_{{ $groupId }}',
                        deadline: '{{ \Carbon\Carbon::parse($batch->waktu_selesai)->format('Y-m-d\TH:i:s') }}'
                    },
                @endforeach
            ];

            function updateTimers() {
                const now = new Date();

                timers.forEach(({
                    id,
                    deadline
                }) => {
                    const el = document.getElementById(id);
                    if (!el) return;

                    const diff = new Date(deadline) - now;

                    if (diff <= 0) {
                        el.textContent = 'Waktu habis!';
                        el.classList.remove('text-[#d71919]');
                        el.classList.add('text-gray-400');
                        return;
                    }

                    const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const s = Math.floor((diff % (1000 * 60)) / 1000);

                    el.textContent = `${d}d : ${h}h : ${m}m : ${s}s`;
                });
            }

            updateTimers();
            setInterval(updateTimers, 1000);
        </script>
    @endif
</main>
