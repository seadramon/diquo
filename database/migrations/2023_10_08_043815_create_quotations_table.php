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
        Schema::create('quo_quotations', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat', 50);
            $table->string('nama_pelanggan', 250)->nullable();
            $table->string('nama_perusahaan', 250)->nullable();
            $table->string('no_hp', 50)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('nama_proyek', 250)->nullable();
            $table->string('lokasi_proyek', 250)->nullable();
            $table->string('kondisi_pengiriman', 50)->nullable();
            $table->string('pic', 100)->nullable();
            $table->string('sbu', 100)->nullable();
            $table->string('kd_material', 100)->nullable();
            $table->string('ket_material', 300)->nullable();
            $table->string('kd_pabrik', 3)->nullable();
            $table->decimal('jarak', 14, 2)->nullable();
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
        Schema::dropIfExists('quotations');
    }
};
