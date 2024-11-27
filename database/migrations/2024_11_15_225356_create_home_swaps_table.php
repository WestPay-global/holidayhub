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
        Schema::create('home_swaps', function (Blueprint $table) {
            $table->id();
            $table->longText('unique_key')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('seeker_id')->nullable(); //user that made offer(offer an exchange)
            $table->string('list_type')->default('homeswap');

            //choose the ones that accurately describe ur place
            $table->json('describe_place_features')->nullable();

            //share with visitors what your place has to offer
            $table->json('what_place_offer_visitors')->nullable();

            //describe a few essential details about your place
            $table->string('guests')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('beds')->nullable();
            $table->string('bathrooms')->nullable();

            //where is your place located?
            $table->string('place_latitude')->nullable();
            $table->string('place_longitude')->nullable();
            $table->string('place_city')->nullable();
            $table->string('place_state')->nullable();
            $table->string('place_country')->nullable();
            $table->string('place_address')->nullable();

            //swap details
            $table->string('preferred_holiday_location_latitude')->nullable();
            $table->string('preferred_holiday_location_longitude')->nullable();
            $table->string('preferred_holiday_location_city')->nullable();
            $table->string('preferred_holiday_location_state')->nullable();
            $table->string('preferred_holiday_location_country')->nullable();
            $table->string('preferred_holiday_location_address')->nullable();

            $table->boolean('open_to_any_location')->default(false);

            $table->date('start_date_to_travel')->nullable(); //Y-m-d
            $table->date('end_date_to_travel')->nullable(); //
            $table->string('swap_type')->default('simultaneous'); //non-simultaneous

            $table->json('place_pictures')->default('place_pictures'); //

            //trip length
            $table->string('available_window_start_date')->nullable();
            $table->string('available_window_end_date')->nullable();
            $table->string('minimum_stay_duration')->default('minimum_stay_duration');
            $table->json('maximum_stay_duration')->default('maximum_stay_duration');

            //set your price
            $table->float('rent_per_night')->nullable();
            $table->float('cleaning_fee')->nullable();
            $table->float('pet_fee')->nullable();

            $table->longText('short_decsription')->nullable();

            //create your description
            $table->longText('what_you_will_love_about_home')->nullable();
            $table->longText('what_you_will_love_about_neighbourhood')->nullable();
            $table->longText('additional_information')->nullable();

            //set rules
            $table->json('set_rules')->nullable();

            $table->string('previous_status')->default('draft'); //used in deactivation/activation actions
            $table->string('status')->default('draft'); //completed, suspended

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_swaps');
    }
};
