<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batch', function (Blueprint $table) {
            $table->increments('id_batch');
            $table->integer('id_procurement')->unsigned()->nullable();
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            
            $table->foreign('id_procurement', 'fk_batch_procurement')->references('id_procurement')->on('procurement')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch');
    }
};
