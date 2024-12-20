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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // User reference
            $table->unsignedBigInteger('list_id');
            $table->unsignedBigInteger('list_offer_id');
            $table->enum('type', ['earning', 'payout']); // Transaction type
            $table->decimal('amount', 10, 2); // Transaction amount
            $table->text('description')->nullable(); // Optional description

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
