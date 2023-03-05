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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->nullable();
            $table->string('email', 200)->unique();
            $table->string('phone_number', 20)->nullable();
            $table->bigInteger('wallet_amount')->nullable();
            $table->bigInteger('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->string('password', 200);
            $table->boolean('should_change_password')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
