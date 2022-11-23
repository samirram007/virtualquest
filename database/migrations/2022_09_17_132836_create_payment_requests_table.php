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
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('amount');
            $table->string('payment_request_date')->nullable();
            $table->string('payment_confirm_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('payment_account')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected','paid'])->default('pending');
            $table->text('note')->nullable();
            $table->integer('confirm_by')->nullable();
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
        Schema::dropIfExists('payment_requests');
    }
};
