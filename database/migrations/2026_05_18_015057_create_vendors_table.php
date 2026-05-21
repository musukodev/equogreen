<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            $table->string('nama_perusahaan');
            $table->string('email_perusahaan');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('kategori_vendor');

            $table->string('penanggung_jawab');
            $table->text('deskripsi')->nullable();

            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kode_pos');

            $table->string('portofolio')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
