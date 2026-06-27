<div>
<div class="flex flex-col gap-6 p-6 lg:p-8">

    @if(session('error'))
        <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm font-semibold flex items-center gap-2">
            <i class="ph-fill ph-warning text-xl"></i>
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-semibold flex items-center gap-2">
            <i class="ph-fill ph-check-circle text-xl"></i>
            {{ session('success') }}
        </div>
    @endif

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
                <h3 class="mb-0.5 text-2xl font-extrabold leading-tight text-black">{{ $totalReview }}</h3>
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
                <h3 class="mb-0.5 text-2xl font-extrabold leading-tight text-black">{{ $totalApproved }}</h3>
                <p class="text-sm font-medium text-gray-500">Selesai</p>
            </div>
        </div>
    </div>

    <!-- Pengumuman Card -->
    <section
        class="flex flex-col items-start justify-between gap-4 rounded-2xl border border-black bg-[#4039c9] px-6 py-5 shadow-md md:flex-row md:items-center md:px-8 md:py-6">
        <div class="flex-1">
            <p class="mb-1 text-sm font-bold uppercase tracking-widest text-white/70">PENGUMUMAN</p>
            <h2 class="mb-2 text-xl font-bold text-white lg:text-2xl">Pengumuman Pengadaan Barang</h2>
            <p class="text-sm text-white/80 lg:text-base">Pastikan Anda membaca notifikasi pada lonceng di atas untuk instruksi terbaru</p>
        </div>
        <!-- Decorative icon area -->
        <div
            class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-[#2d4ddd]/65 md:h-20 md:w-20">
            <img src="/gambar/pengumuman.png" alt="banner icon"
                class="h-10 w-10 rounded-full object-cover md:h-12 md:w-12" />
        </div>
    </section>

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
    <div class="grid grid-cols-1 gap-4 pb-20 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 md:gap-4">
        @forelse($groupedPenawarans as $groupId => $items)
            @php 
                $batch = $items->first()->batch; 
                $vendor_id = Auth::user()->vendor->id_vendor ?? null;
                $firstPenawaranId = $items->first()->id_penawaran;
                
                // Cek status upload quotation vendor
                $quotation = null;
                if ($vendor_id) {
                    $quotation = \App\Models\Quotation::where('id_vendor', $vendor_id)
                        ->where('id_penawaran', $firstPenawaranId)
                        ->first();
                }
                $qStatus = $quotation ? $quotation->status : 'none';
            @endphp
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
                    
                    <!-- Badge Status Dinamis -->
                    <div class="absolute top-3 right-3">
                        @if ($qStatus === 'approved')
                            <span class="rounded-full bg-green-500 px-3 py-1 text-[10px] font-extrabold uppercase tracking-wide text-white shadow-sm">
                                Approved
                            </span>
                        @elseif ($qStatus === 'rejected')
                            <span class="rounded-full bg-red-500 px-3 py-1 text-[10px] font-extrabold uppercase tracking-wide text-white shadow-sm">
                                Rejected
                            </span>
                        @elseif ($qStatus === 'pending')
                            <span class="rounded-full bg-amber-500 px-3 py-1 text-[10px] font-extrabold uppercase tracking-wide text-white shadow-sm">
                                Pending
                            </span>
                        @endif
                    </div>
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

                    @php
                        $isExpired = \Carbon\Carbon::parse($batch->waktu_selesai)->isPast();
                    @endphp

                    <!-- Tampilkan timer hanya jika belum disetujui, belum ditolak, dan belum expired -->
                    @if ($qStatus === 'approved')
                        <p class="mb-5 text-[11px] font-extrabold text-green-600 flex items-center gap-1">
                            <i class="fa-solid fa-circle-check"></i> Pengadaan Selesai
                        </p>
                    @elseif ($qStatus === 'rejected')
                        <p class="mb-5 text-[11px] font-extrabold text-gray-400 flex items-center gap-1">
                            <i class="fa-solid fa-circle-xmark"></i> Pengadaan Ditolak
                        </p>
                    @elseif ($isExpired)
                        <p class="mb-5 text-[11px] font-extrabold text-gray-400 flex items-center gap-1">
                            <i class="fa-regular fa-clock"></i> Waktu Habis!
                        </p>
                    @else
                        <p id="timer_{{ $groupId }}" class="mb-5 text-[11px] font-extrabold text-[#d71919]"></p>
                    @endif

                    @if ($qStatus === 'approved')
                        <!-- Jika disetujui, arahkan ke rute PO Document -->
                        <a href="{{ route('po.show', ['id_vendor' => $vendor_id, 'id_penawaran' => $firstPenawaranId]) }}"
                            class="mt-auto block w-full rounded-lg bg-green-600 py-3 text-center text-sm font-bold text-white transition hover:bg-green-700"
                            wire:navigate>
                            Lihat PO
                        </a>
                    @elseif ($qStatus === 'rejected')
                        <!-- Jika ditolak, tampilkan tombol non-aktif abu-abu -->
                        <button class="mt-auto block w-full rounded-lg bg-gray-200 py-3 text-center text-sm font-bold text-gray-400 cursor-not-allowed" disabled>
                            Quotation Tidak Terpilih
                        </button>
                    @elseif ($isExpired)
                        <!-- Jika waktu habis -->
                        @if ($qStatus === 'pending')
                            <!-- Jika sudah kirim dan expired: hanya bisa lihat detail -->
                            <a href="{{ route('vendor-buat_quotation', $groupId) }}"
                                class="mt-auto block w-full rounded-lg bg-gray-600 py-3 text-center text-sm font-bold text-white transition hover:bg-gray-700"
                                wire:navigate>
                                Lihat Detail
                            </a>
                        @else
                            <!-- Jika belum kirim dan expired: ditutup -->
                            <button class="mt-auto block w-full rounded-lg bg-gray-200 py-3 text-center text-sm font-bold text-gray-400 cursor-not-allowed" disabled>
                                Pengadaan Ditutup
                            </button>
                        @endif
                    @elseif ($qStatus === 'pending')
                        <!-- Jika pending dan belum expired, beri tombol lihat/edit -->
                        <a href="{{ route('vendor-buat_quotation', $groupId) }}"
                            class="mt-auto block w-full rounded-lg bg-amber-500 py-3 text-center text-sm font-bold text-white transition hover:bg-amber-600"
                            wire:navigate>
                            Ubah Quotation
                        </a>
                    @else
                        <!-- Jika belum submit dan belum expired -->
                        <a href="{{ route('vendor-buat_quotation', $groupId) }}"
                            class="mt-auto block w-full rounded-lg bg-[#1e40ff] py-3 text-center text-sm font-bold text-white transition hover:bg-blue-700"
                            wire:navigate>
                            Buka Quotation
                        </a>
                    @endif
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
</div>
</div>
