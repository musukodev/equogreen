<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penawaran', function (Blueprint $table) {
            $table->increments('id_penawaran');
            $table->integer('id_batch')->unsigned()->nullable();
            $table->string('nama_barang', 255);
            $table->text('spesifikasi')->nullable();
            $table->integer('jumlah')->nullable();
            
            $table->foreign('id_batch', 'fk_penawaran_batch')->references('id_batch')->on('batch')->onDelete('cascade');
        });
        
        DB::statement("ALTER TABLE penawaran ADD CONSTRAINT chk_penawaran_jumlah CHECK (jumlah > 0)");
    }

    public function down(): void
    {
        Schema::dropIfExists('penawaran');
    }
};
