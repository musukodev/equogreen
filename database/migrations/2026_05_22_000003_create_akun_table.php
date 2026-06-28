<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->increments('id_akun');
            $table->string('username', 100)->unique();
            $table->string('password', 255);
            $table->string('role', 50);
            $table->integer('id_procurement')->unsigned()->nullable();
            $table->integer('id_vendor')->unsigned()->nullable();
            
            $table->foreign('id_procurement', 'fk_akun_procurement')->references('id_procurement')->on('procurement')->onDelete('cascade');
            $table->foreign('id_vendor', 'fk_akun_vendor')->references('id_vendor')->on('vendor')->onDelete('cascade');
        });
        
        DB::statement("ALTER TABLE akun ADD CONSTRAINT chk_akun_role CHECK (role in ('Vendor','Procurement','Superadmin'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
