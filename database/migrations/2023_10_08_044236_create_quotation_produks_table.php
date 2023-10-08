<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quo_quotation_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quo_quotations');
            $table->string('sbu', 100)->nullable();
            $table->string('kd_produk', 200)->nullable();
            $table->string('tipe_produk', 200)->nullable();
            $table->decimal('harsat_produk', 14, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotation_produks');
    }
};
