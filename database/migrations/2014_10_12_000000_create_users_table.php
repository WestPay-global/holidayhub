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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('auto_login_token')->nullable();
            $table->rememberToken();
            $table->string('guest_points')->nullable();
            $table->string('profile_picture')->nullable();
            $table->longText('fcm_device_token')->nullable();
            $table->longText('user_remember_token')->nullable(); //will be used to check credentials while navigating diff apps/sites from roomzhub
            $table->string('signin_type')->default('email');
            $table->string('phone_number')->nullable();

            $table->longText('about')->nullable();

            $table->string('current_latitude')->nullable();
            $table->string('current_longitude')->nullable();
            $table->string('current_city')->nullable();
            $table->string('current_state')->nullable();
            $table->string('current_country')->nullable();
            $table->string('current_address')->nullable();

            $table->boolean('has_homeswap')->default(false);
            $table->boolean('has_nonswap')->default(false);
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
