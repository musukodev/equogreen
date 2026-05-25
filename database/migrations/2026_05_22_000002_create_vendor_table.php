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
            $table->string('nama_vendor', 255);
            $table->string('kategori', 100)->nullable();
            $table->text('alamat');
            $table->string('email', 255)->unique();
            $table->string('no_telp', 20)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('status', 50)->default('Pending');
        });
        
        DB::statement("ALTER TABLE vendor ADD CONSTRAINT chk_vendor_status CHECK (status in ('Pending','Aktif','Suspend'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor');
    }
};
