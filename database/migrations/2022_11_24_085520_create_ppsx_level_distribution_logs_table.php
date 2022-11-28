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
        Schema::create('ppsx_level_distribution_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->date('log_date')->nullable();
            $table->integer('investment_id')->nullable();
            $table->integer('amount')->nullable();
            $table->decimal('percentage',10,6)->nullable();
            $table->integer('level')->default(0);
            $table->integer('day_count')->nullable();
            $table->decimal('commission', 10, 6)->default(0);
            $table->decimal('cumulative_commission', 10, 6)->default(0);
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
        Schema::dropIfExists('ppsx_level_distribution_logs');
    }
};
