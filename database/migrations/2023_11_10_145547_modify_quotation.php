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
            $table->string('status', 50)->nullable();
            $table->string('se_id', 50)->nullable();
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
            $table->dropColumn(['status', 'se_id']);
        });
    }
};
