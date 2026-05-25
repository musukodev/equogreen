<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->increments('id_pengumuman');
            $table->integer('id_vendor')->unsigned()->nullable();
            $table->string('judul', 255);
            $table->text('isi')->nullable();
            $table->dateTime('waktu');
            
            $table->foreign('id_vendor', 'fk_pengumuman_vendor')->references('id_vendor')->on('vendor')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
