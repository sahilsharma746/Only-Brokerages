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
            $table->string('market');
            $table->integer('margin');
            $table->float('contract_size', 10, 10);
            $table->float('capital', 10, 10);
            $table->string('trade_type');
            $table->float('entry', 10, 10);
            $table->float('units', 10, 10);
            $table->float('pnl', 10, 10);
            $table->float('fees', 10, 10);
            $table->string('order_type');
            $table->string('time_frame');
            $table->string('trade_result');
            $table->float('admin_trade_result_percentage', 8, 2);
            $table->tinyInteger('processed');
            $table->tinyInteger('status');
            $table->string('image');
            $table->string('avatar')->nullable();
            $table->string('trade_execution_method');
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
