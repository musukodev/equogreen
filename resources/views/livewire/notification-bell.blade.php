<div class="relative" x-data="{ openNotifications: false }">
    <!-- Tombol Lonceng Notifikasi -->
    <button @click="openNotifications = !openNotifications; if(openNotifications) { $wire.markAsRead() }"
        class="w-9 h-9 md:w-11 md:h-11 lg:w-12 lg:h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200 relative">
        <img src="/gambar/bell-black.png" alt="Notifikasi" class="w-5 h-5 lg:w-6 lg:h-6 object-contain" />
        @if($unreadCount > 0)
            <span class="absolute -top-0.5 -right-0.5 md:-top-1 md:-right-1 w-4 h-4 md:w-5 md:h-5 bg-red-500 text-white text-[9px] md:text-[10px] font-extrabold flex items-center justify-center rounded-full animate-pulse">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Dropdown List Notifikasi -->
    <div x-show="openNotifications" 
         @click.away="openNotifications = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-[-10px] sm:right-0 mt-2 w-[85vw] sm:w-96 max-w-sm bg-white border border-gray-200 rounded-2xl shadow-xl p-4 z-50 flex flex-col gap-3"
         style="display: none;" x-cloak>
        <h4 class="font-bold text-gray-800 border-b pb-2 text-sm flex items-center justify-between">
            <span>Notifikasi</span>
            <span class="text-xs text-gray-400 font-normal">Terbaru</span>
        </h4>
        <div class="max-h-60 overflow-y-auto flex flex-col gap-2.5 pr-1">
            @forelse($notifications as $notif)
                <div class="p-3 rounded-xl bg-gray-50 border border-gray-100 hover:bg-gray-100 transition duration-150 flex flex-col gap-1 text-left">
                    <p class="text-xs text-gray-700 leading-relaxed font-medium">{{ $notif->isi }}</p>
                    <span class="text-[9px] text-gray-400 font-bold self-end">{{ $notif->created_at ? $notif->created_at->diffForHumans() : '-' }}</span>
                </div>
            @empty
                <div class="text-center py-6 flex flex-col items-center gap-2">
                    <i class="ph ph-bell-slash text-2xl text-gray-300"></i>
                    <p class="text-xs text-gray-400 font-medium">Tidak ada notifikasi baru</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
