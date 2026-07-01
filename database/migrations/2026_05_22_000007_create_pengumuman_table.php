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
            $table->integer('id_procurement')->unsigned()->nullable();
            $table->text('isi')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            
            $table->foreign('id_vendor', 'fk_pengumuman_vendor')->references('id_vendor')->on('vendor')->onDelete('cascade');
            $table->foreign('id_procurement', 'fk_pengumuman_procurement')->references('id_procurement')->on('procurement')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
