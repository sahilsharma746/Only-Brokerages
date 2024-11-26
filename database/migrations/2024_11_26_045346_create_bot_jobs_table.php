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
        Schema::create('bot_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bot_id');
            $table->enum('status', ['pending', 'in_progress', 'completed']);
            $table->string('trade_asset')->nullable();
            $table->decimal('percentage_gain_or_loss', 5, 2)->nullable();
            $table->string('trade_result')->nullable();
            $table->string('market')->nullable();
            $table->decimal('capital', 15, 2)->nullable();
            $table->string('time_frame')->nullable();
            $table->string('trade_count')->nullable();
            $table->string('order_type')->nullable();
            $table->string('margin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_jobs');
    }
};
