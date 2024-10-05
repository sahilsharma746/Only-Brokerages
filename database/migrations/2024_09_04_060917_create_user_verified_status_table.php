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
        if (!Schema::hasTable('user_verified_status')) {
            Schema::create('user_verified_status', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id'); // Assuming user_id is a foreign key referencing the users table
                $table->enum('kyc_verify_status', ['pending', 'verified', 'rejected','unverified']); // Using enum for fixed set of values
                $table->enum('email_verify_status', ['pending', 'verified', 'rejected']);
                $table->enum('phone_verify_status', ['pending', 'verified', 'rejected']);
                $table->tinyInteger('2fa_verify_status')->comment('0=no, 1=yes');
                $table->tinyInteger('kyc_id_front')->comment('0=no, 1=user_uploaded, 2=approve , 3=reject');                
                $table->tinyInteger('kyc_id_back')->comment('0=no,1=user_uploaded, 2=approve , 3=reject');
                $table->tinyInteger('kyc_address_proof')->comment('0=no, 1=user_uploaded, 2=approve , 3=reject');
                $table->tinyInteger('kyc_selfie_proof')->comment('0=no, 1=user_uploaded, 2=approve , 3=reject');
                $table->tinyInteger('upgrade_prompt')->comment('0=no, 1=yes');
                $table->tinyInteger('certificate_prompt')->comment('0=no, 1=yes');
                $table->tinyInteger('identity_prompt')->comment('0=no, 1=yes');
                $table->tinyInteger('custom_prompt')->comment('0=no, 1=yes');
                $table->tinyInteger('demo')->comment('0=no, 1=yes');
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
