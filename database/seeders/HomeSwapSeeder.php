<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeSwapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for the seekers table
        $properties = [
            [
                'created_by' => 1,
                'seeker_id' => null,

                'describe_place_features' => json_encode(['House', 'Apartment', 'Barn', 'Bed & Breakfast', 'Boat']),

                'what_place_offer_visitors' => json_encode(['Wifi', 'Television', 'Washer', 'Free Parking on Premises']),

                'guests' => 3,
                'bedrooms' => 3,
                'beds' => 3,
                'bathrooms' => 3,

                'place_latitude' => 30.123446758,
                'place_longitude' => 10.123446758,
                'place_city' => 'Melbourne',
                'place_state' => 'Melbourne',
                'place_country' => 'Australia',
                'place_address' => '23 Melbourne Street, Lakemba, Australia',

                'preferred_holiday_location_latitude' => 30.123446758,
                'preferred_holiday_location_longitude' => 10.123446758,
                'preferred_holiday_location_city' => 'Melbourne',
                'preferred_holiday_location_state' => 'Melbourne',
                'preferred_holiday_location_country' => 'Australia',
                'preferred_holiday_location_address' => '23 Melbourne Street, Lakemba, Australia',

                'open_to_any_location' => false,

                'start_date_to_travel' => '2024-12-20',
                'end_date_to_travel' => '2024-12-20',
                'swap_type' => 'simultaneous',

                'place_pictures' => json_encode(['https://res.cloudinary.com/funnel/image/upload/v1718602768/properties/g4h9uy1kz8bz4aowqlv2.jpg',
                'https://res.cloudinary.com/funnel/image/upload/v1718602769/properties/dskiwstdlalkadepuypb.jpg',
                'https://res.cloudinary.com/funnel/image/upload/v1718602767/properties/z8wda983oocrwvlu7ynr.jpg'
                ]),

                'available_window_start_date' => '2024-12-20',
                'available_window_end_date' => '2024-12-23',
                'minimum_stay_duration' => '2',
                'maximum_stay_duration' => '3',

                'rent_per_night' => 20.00,
                'cleaning_fee' => 10.00,
                'pet_fee' => 5.00,

                'short_decsription' => 'lorem ipsum short description is best for testing content place homw swap',

                'what_you_will_love_about_home' => 'you will learn this about ipsum short description is best for testing content place homw swap',
                'what_you_will_love_about_neighbourhood' => 'love this bout nefighboruhood ipsum short description is best for testing content place homw swap',
                'additional_information' => 'additional information ipsum short description is best for testing content place homw swap',

                'set_rules' => json_encode(['Suitable for infants', 'Suitable for children', 'Pets allowed']),

                'previous_status' => 'completed',
                'status' => 'completed',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'created_by' => 1,
                'seeker_id' => null,

                'describe_place_features' => json_encode(['House', 'Apartment', 'Barn', 'Bed & Breakfast', 'Boat']),

                'what_place_offer_visitors' => json_encode(['Wifi', 'Television', 'Washer', 'Free Parking on Premises']),

                'guests' => 3,
                'bedrooms' => 3,
                'beds' => 3,
                'bathrooms' => 3,

                'place_latitude' => 30.123446758,
                'place_longitude' => 10.123446758,
                'place_city' => 'Melbourne',
                'place_state' => 'Melbourne',
                'place_country' => 'Australia',
                'place_address' => '23 Melbourne Street, Lakemba, Australia',

                'preferred_holiday_location_latitude' => 30.123446758,
                'preferred_holiday_location_longitude' => 10.123446758,
                'preferred_holiday_location_city' => 'Melbourne',
                'preferred_holiday_location_state' => 'Melbourne',
                'preferred_holiday_location_country' => 'Australia',
                'preferred_holiday_location_address' => '23 Melbourne Street, Lakemba, Australia',

                'open_to_any_location' => false,

                'start_date_to_travel' => '2024-12-20',
                'end_date_to_travel' => '2024-12-20',
                'swap_type' => 'simultaneous',

                'place_pictures' => json_encode(['https://res.cloudinary.com/funnel/image/upload/v1718602768/properties/g4h9uy1kz8bz4aowqlv2.jpg',
                'https://res.cloudinary.com/funnel/image/upload/v1718602769/properties/dskiwstdlalkadepuypb.jpg',
                'https://res.cloudinary.com/funnel/image/upload/v1718602767/properties/z8wda983oocrwvlu7ynr.jpg'
                ]),

                'available_window_start_date' => '2024-12-20',
                'available_window_end_date' => '2024-12-23',
                'minimum_stay_duration' => '2',
                'maximum_stay_duration' => '3',

                'rent_per_night' => 20.00,
                'cleaning_fee' => 10.00,
                'pet_fee' => 5.00,

                'short_decsription' => 'lorem ipsum short description is best for testing content place homw swap',

                'what_you_will_love_about_home' => 'you will learn this about ipsum short description is best for testing content place homw swap',
                'what_you_will_love_about_neighbourhood' => 'love this bout nefighboruhood ipsum short description is best for testing content place homw swap',
                'additional_information' => 'additional information ipsum short description is best for testing content place homw swap',

                'set_rules' => json_encode(['Suitable for infants', 'Suitable for children', 'Pets allowed']),

                'previous_status' => 'completed',
                'status' => 'completed',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        try {
            // Insert data into the seekers table
            DB::table('home_swaps')->insert($properties);
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
