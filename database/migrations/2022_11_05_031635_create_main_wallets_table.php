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
        Schema::create('main_wallets', function (Blueprint $table) {
            $table->id();
            $table->date('transfer_date')->nullable();
            $table->enum('sub_wallet',['pps','pps_level','rld',])->nullable();
            $table->bigInteger('distribution_id')->nullable();
            $table->bigInteger('user_id');
            $table->decimal('amount',10,6);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('main_wallets');
    }
};
