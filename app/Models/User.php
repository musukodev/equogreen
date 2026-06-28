<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Vendor;

#[Fillable(['username', 'password', 'role', 'id_procurement', 'id_vendor'])]
#[Hidden(['password'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    public $timestamps = false;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function vendor()
{
    return $this->belongsTo(Vendor::class, 'id_vendor');
}
    public function procurement()
    {
        return $this->belongsTo(Procurement::class, 'id_procurement');
    }

    /**
     * Normalisasi nomor handphone ke format standar 628xxxxxxxx
     */
    public static function normalizePhone($phone)
    {
        if (empty($phone)) {
            return $phone;
        }

        // Hapus semua karakter non-numerik
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Jika diawali dengan 0, ubah menjadi 62
        if (strpos($phone, '0') === 0) {
            $phone = '62' . substr($phone, 1);
        }

        // Jika diawali dengan 8 langsung, tambahkan 62 di depannya
        if (strpos($phone, '8') === 0) {
            $phone = '62' . $phone;
        }

        return $phone;
    }

}