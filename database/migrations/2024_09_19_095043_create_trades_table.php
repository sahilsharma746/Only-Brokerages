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
       Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('asset');
            $table->string('name');
            $table->integer('margin');  // Changed margin to integer
            $table->float('contract_size', 10, 10);  // Changed from decimal to float
            $table->float('capital', 10, 10);  // Changed from decimal to float
            $table->string('trade_type');
            $table->float('entry', 10, 10);  // Changed from decimal to float
            $table->float('units', 10, 10);  // Changed from decimal to float
            $table->float('pnl', 10, 10);  // Changed from decimal to float
            $table->float('fees', 10, 10);  // Changed from decimal to float
            $table->string('order_type'); 
            $table->string('time_frame'); 
            $table->string('trade_result');
            $table->float('admin_trade_result_percentage', 8, 2);  // Changed from decimal to float (8,2 for percentage precision)
            // $table->float('trade_win_loss_amount', 10, 10);  // Changed from decimal to float
            $table->tinyInteger('processed');
            $table->tinyInteger('status');
            $table->string('image');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
