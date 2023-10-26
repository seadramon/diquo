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
        Schema::table('quo_quotation_produks', function (Blueprint $table) {
            $table->integer('volume')->nullable();
            $table->decimal('total', 14, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quo_quotation_products', function (Blueprint $table) {
            $table->dropColumn(['volume', 'total']);
        });
    }
};
