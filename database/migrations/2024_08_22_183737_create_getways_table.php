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
        if (!Schema::hasTable('getways')) {
            Schema::create('getways', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('tab_id');
                $table->string('address');
                $table->string('address_setting_key')->nullable();
                $table->string('address_tag_setting_key')->nullable();
                $table->string('deposit')->default('yes');
                $table->string('withdraw')->default('yes');
                $table->string('logo');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('getways');
    }
};
