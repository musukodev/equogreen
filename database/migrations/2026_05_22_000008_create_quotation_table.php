<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation', function (Blueprint $table) {
            $table->increments('id_quotation');
            $table->integer('id_vendor')->unsigned()->nullable();
            $table->integer('id_penawaran')->unsigned()->nullable();
            $table->string('no_item', 100)->nullable();
            $table->string('coll_no', 100)->nullable();
            $table->string('rfq_no', 100)->nullable();
            $table->string('material_no', 100);
            $table->text('description');
            $table->integer('qty');
            $table->string('uom', 50)->nullable();
            $table->string('currency', 10)->default('IDR')->nullable();
            $table->decimal('net_price', 15, 2);
            $table->string('incoterm', 100)->nullable();
            $table->string('destination', 255)->nullable();
            $table->text('remark_1')->nullable();
            $table->text('remark_2')->nullable();
            $table->string('payment_term', 100)->nullable();
            $table->integer('lead_time_weeks')->nullable();
            $table->date('quotation_date');
            $table->string('status', 20)->default('pending');
            $table->foreign('id_vendor', 'fk_quotation_vendor')->references('id_vendor')->on('vendor')->onDelete('cascade');
            $table->foreign('id_penawaran', 'fk_quotation_penawaran')->references('id_penawaran')->on('penawaran')->onDelete('cascade');
            $table->timestamps();
        });
        
        DB::statement("ALTER TABLE quotation ADD CONSTRAINT chk_quotation_qty CHECK (qty > 0)");
        DB::statement("ALTER TABLE quotation ADD CONSTRAINT chk_quotation_net_price CHECK (net_price >= 0)");
        DB::statement("ALTER TABLE quotation ADD CONSTRAINT chk_quotation_lead_time CHECK (lead_time_weeks >= 0)");
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation');
    }
};
