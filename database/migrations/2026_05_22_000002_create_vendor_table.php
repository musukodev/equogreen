<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->increments('id_vendor');
            $table->string('nama_perusahaan', 255);
            $table->string('email_perusahaan', 255)->unique();
            $table->string('no_hp', 20);
            $table->text('alamat');
            $table->string('kategori_vendor', 100);
            $table->string('penanggung_jawab', 255);
            $table->text('deskripsi');
            $table->string('provinsi', 100);
            $table->string('kota', 100);
            $table->string('kecamatan', 100);
            $table->string('kode_pos', 20);
            $table->string('portofolio', 255)->nullable();
            $table->string('status', 50)->default('Pending');
        });
        
        DB::statement("ALTER TABLE vendor ADD CONSTRAINT chk_vendor_status CHECK (status in ('Pending','Aktif','Suspend','approved','rejected'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor');
    }
};
