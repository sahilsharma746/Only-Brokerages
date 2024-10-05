<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('withdraws')) {
            Schema::create('withdraws', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('getway_id');
                $table->string('payment_method');
                $table->string('wallet_address');
                $table->string('address_tag');
                $table->float('amount');
                $table->string('remarks')->nullable();
                $table->enum('status', array('pending', 'approved', 'rejected' ,'deleted'))->default('pending');
                $table->string('withdrawl_by')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};
