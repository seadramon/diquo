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
        Schema::table('quo_quotations', function (Blueprint $table) {
            $table->string('app1_jbt', 100)->nullable();
            $table->string('app2_jbt', 100)->nullable();
        });
        Schema::table('quo_quotation_produks', function (Blueprint $table) {
            $table->decimal('ton', 14, 2)->nullable();
            $table->decimal('panjang', 14, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quo_quotations', function (Blueprint $table) {
            $table->dropColumn(['app1_jbt', 'app2_jbt']);
        });
        Schema::table('quo_quotation_produks', function (Blueprint $table) {
            $table->dropColumn(['ton', 'panjang']);
        });
    }
};
