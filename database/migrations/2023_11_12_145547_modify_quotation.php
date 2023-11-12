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
            $table->foreignId('parent_id')->nullable()->constrained('quo_quotations');
            $table->string('app1', 2)->default("0");
            $table->timestamp('app1_date')->nullable();
            $table->string('app2', 2)->default("0");
            $table->timestamp('app2_date')->nullable();
            $table->string('app2_id', 30)->nullable();
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
            $table->dropColumn(['parent_id', 'app1', 'app1_date', 'app2', 'app2_date', 'app2_id']);
        });
    }
};
