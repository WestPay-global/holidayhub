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
        Schema::create('non_swaps', function (Blueprint $table) {
            $table->id();
            $table->longText('unique_key')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('seeker_id')->nullable(); //user that made offer(offer an exchange)
            $table->string('list_type')->default('nonswap');

            //choose the ones that accurately describe ur place
            $table->json('describe_place_features')->nullable(); //

            //share with visitors what your place has to offer
            $table->json('what_place_offer_visitors')->nullable(); //

            //where is your place located?
            $table->string('place_latitude')->nullable();
            $table->string('place_longitude')->nullable();
            $table->string('place_city')->nullable();
            $table->string('place_state')->nullable();
            $table->string('place_country')->nullable();
            $table->string('place_address')->nullable();

            //describe a few essential details about your place
            $table->string('guests')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('beds')->nullable();
            $table->string('bathrooms')->nullable();

            $table->json('what_place_has_to_offer')->nullable(); //

            $table->json('place_pictures')->default('place_pictures'); //

            //assign a house title to ur listing
            $table->longText('house_precise_title')->nullable();
            $table->json('best_describe_your_place')->nullable();

            //create your description
            $table->longText('describe_house_in_detail')->nullable(); //

            //set your price
            $table->float('rent_per_night')->nullable();
            $table->float('cleaning_fee')->nullable(); //per stay
            $table->float('pet_fee')->nullable(); //per stay

            //trip length
            $table->string('available_window_start_date')->nullable();
            $table->string('available_window_end_date')->nullable();
            $table->string('minimum_stay_duration')->default('minimum_stay_duration');
            $table->json('maximum_stay_duration')->default('maximum_stay_duration');

            //set rules
            $table->json('set_rules')->nullable();

            $table->string('previous_status')->default('draft'); //used in deactivation/activation actions
            $table->string('status')->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_swaps');
    }
};
