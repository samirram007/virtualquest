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
        Schema::create('pps_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scheme_id');
            $table->integer('target_amount')->default(0);
            $table->decimal('pos', 10, 2)->default(0);
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
        Schema::dropIfExists('pps_commissions');
    }
};
