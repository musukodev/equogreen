<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penawaran_vendor', function (Blueprint $table) {
            $table->increments('id_pv');
            $table->integer('id_penawaran')->unsigned()->nullable();
            $table->integer('id_vendor')->unsigned()->nullable();
            
            $table->foreign('id_penawaran', 'fk_pv_penawaran')->references('id_penawaran')->on('penawaran')->onDelete('cascade');
            $table->foreign('id_vendor', 'fk_pv_vendor')->references('id_vendor')->on('vendor')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penawaran_vendor');
    }
};
