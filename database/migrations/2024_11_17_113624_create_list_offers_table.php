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
        Schema::create('list_offers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('owner_id')->nullable(); //owner of the original list
            $table->unsignedBigInteger('seeker_id')->nullable(); //createdby(the person that made the offer)
            $table->unsignedBigInteger('list_id')->nullable();
            $table->string('list_type')->nullable();
            $table->date('check_in')->nullable(); //'Y-m-d
            $table->date('check_out')->nullable(); //'Y-m-d

            $table->string('exchange_type')->default('reciprocal');

            $table->unsignedBigInteger('no_of_adults')->default(0);
            $table->unsignedBigInteger('no_of_children')->nullable(0);
            $table->unsignedBigInteger('no_of_infants')->nullable(0);

            $table->longText('initial_message')->nullable();

            $table->boolean('owner_pre_approve')->default(false);
            $table->datetime('owner_pre_approve_at')->nullable();

            $table->boolean('owner_cancel')->default(false);
            $table->datetime('owner_cancel_at')->nullable();
            $table->longText('owner_cancel_reason')->nullable();

            $table->boolean('seeker_cancel')->default(false);
            $table->datetime('seeker_cancel_at')->nullable();
            $table->longText('seeker_cancel_reason')->nullable();

            $table->string('status')->default('pending'); //upcoming, cancelled, completed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_offers');
    }
};
