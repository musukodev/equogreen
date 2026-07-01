<?php

namespace App\Livewire;

use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationBell extends Component
{
    public $notifications = [];
    public $unreadCount = 0;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();
        $role = strtolower($user->role);

        if ($role === 'superadmin' || $role === 'procurement') {
            $idProc = $user->id_procurement;
            
            // Mengambil semua notifikasi yang ditargetkan khusus untuk admin ini
            $this->notifications = Pengumuman::whereNull('id_vendor')
                ->where('id_procurement', $idProc)
                ->orderBy('created_at', 'desc')
                ->get();

            // Hitung notifikasi yang belum dibaca (is_read = false)
            $this->unreadCount = Pengumuman::whereNull('id_vendor')
                ->where('id_procurement', $idProc)
                ->where('is_read', false)
                ->count();

        } elseif ($role === 'vendor') {
            $vendorId = $user->vendor->id_vendor ?? null;

            if ($vendorId) {
                // Mengambil notifikasi milik vendor tersebut
                $this->notifications = Pengumuman::whereNotNull('id_vendor')
                    ->where('id_vendor', $vendorId)
                    ->orderBy('created_at', 'desc')
                    ->get();

                // Hitung notifikasi yang belum dibaca (is_read = false)
                $this->unreadCount = Pengumuman::whereNotNull('id_vendor')
                    ->where('id_vendor', $vendorId)
                    ->where('is_read', false)
                    ->count();
            }
        }
    }

    public function markAsRead()
    {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();
        $role = strtolower($user->role);

        if ($role === 'superadmin' || $role === 'procurement') {
            $idProc = $user->id_procurement;
            
            Pengumuman::whereNull('id_vendor')
                ->where('id_procurement', $idProc)
                ->where('is_read', false)
                ->update(['is_read' => true]);

        } elseif ($role === 'vendor') {
            $vendorId = $user->vendor->id_vendor ?? null;

            if ($vendorId) {
                Pengumuman::whereNotNull('id_vendor')
                    ->where('id_vendor', $vendorId)
                    ->where('is_read', false)
                    ->update(['is_read' => true]);
            }
        }

        // Muat ulang setelah data is_read diubah
        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
