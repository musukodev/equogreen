<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procurement', function (Blueprint $table) {
            $table->increments('id_procurement');
            $table->string('nama_procurement', 255);
            $table->string('email', 255)->nullable()->unique();
            $table->string('no_hp', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procurement');
    }
};
