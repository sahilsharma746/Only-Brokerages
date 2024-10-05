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
        if (!Schema::hasTable('user_account_types')) {
            Schema::create('user_account_types', function (Blueprint $table) {
                $table->bigIncrements('id'); // or $table->increments('id') for smaller tables
                $table->string('name');
                $table->decimal('price', 10, 2); // Assuming price is a decimal value with 2 places
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_account_types');
    }
};
