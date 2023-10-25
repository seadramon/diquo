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
        Schema::create('quo_quotation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek', 200)->nullable();
            $table->string('nama_pelanggan', 200)->nullable();
            $table->date('request_date')->nullable();
            $table->string('pic', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotation_requests');
    }
};
