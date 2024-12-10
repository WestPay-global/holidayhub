<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NonSwapSeeder extends Seeder
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

                'what_place_offer_visitors' => json_encode(['An entire space', 'A private room', 'Shared room']),

                'place_latitude' => 30.123446758,
                'place_longitude' => 10.123446758,
                'place_city' => 'Melbourne',
                'place_state' => 'Melbourne',
                'place_country' => 'Australia',
                'place_address' => '23 Melbourne Street, Lakemba, Australia',

                'guests' => 3,
                'bedrooms' => 3,
                'beds' => 3,
                'bathrooms' => 3,

                'what_place_has_to_offer' => json_encode(['WiFi', 'Television', 'Washer']),

                'place_pictures' => json_encode(['https://res.cloudinary.com/funnel/image/upload/v1718602768/properties/g4h9uy1kz8bz4aowqlv2.jpg',
                'https://res.cloudinary.com/funnel/image/upload/v1718602769/properties/dskiwstdlalkadepuypb.jpg',
                'https://res.cloudinary.com/funnel/image/upload/v1718602767/properties/z8wda983oocrwvlu7ynr.jpg'
                ]),

                'house_precise_title' => 'Nice place',
                'best_describe_your_place' => json_encode(['Peaceful', 'Unique']),

                'describe_house_in_detail' => 'lorem ipsum short description is best for testing content place homw swap',

                'rent_per_night' => 20.00,
                'cleaning_fee' => 10.00,
                'pet_fee' => 5.00,

                'available_window_start_date' => Carbon::parse('2024-12-20')->format('Y-m-d'),
                'available_window_end_date' => Carbon::parse('2024-12-23')->format('Y-m-d'),
                'minimum_stay_duration' => '2',
                'maximum_stay_duration' => '3',

                'set_rules' => json_encode(['Suitable for infants', 'Suitable for children', 'Pets allowed']),

                'previous_status' => 'completed',
                'status' => 'completed',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'created_by' => 2,
                'seeker_id' => null,

                'describe_place_features' => json_encode(['House', 'Apartment', 'Barn', 'Bed & Breakfast', 'Boat']),

                'what_place_offer_visitors' => json_encode(['An entire space', 'A private room', 'Shared room']),

                'place_latitude' => 30.123446758,
                'place_longitude' => 10.123446758,
                'place_city' => 'Melbourne',
                'place_state' => 'Melbourne',
                'place_country' => 'Australia',
                'place_address' => '23 Melbourne Street, Lakemba, Australia',

                'guests' => 3,
                'bedrooms' => 3,
                'beds' => 3,
                'bathrooms' => 3,

                'what_place_has_to_offer' => json_encode(['WiFi', 'Television', 'Washer']),

                'place_pictures' => json_encode(['https://res.cloudinary.com/funnel/image/upload/v1718602768/properties/g4h9uy1kz8bz4aowqlv2.jpg',
                'https://res.cloudinary.com/funnel/image/upload/v1718602769/properties/dskiwstdlalkadepuypb.jpg',
                'https://res.cloudinary.com/funnel/image/upload/v1718602767/properties/z8wda983oocrwvlu7ynr.jpg'
                ]),

                'house_precise_title' => 'Nice place',
                'best_describe_your_place' => json_encode(['Peaceful', 'Unique']),

                'describe_house_in_detail' => 'lorem ipsum short description is best for testing content place homw swap',

                'rent_per_night' => 20.00,
                'cleaning_fee' => 10.00,
                'pet_fee' => 5.00,

                'available_window_start_date' => Carbon::parse('2024-12-20')->format('Y-m-d'),
                'available_window_end_date' => Carbon::parse('2024-12-23')->format('Y-m-d'),
                'minimum_stay_duration' => '2',
                'maximum_stay_duration' => '3',

                'set_rules' => json_encode(['Suitable for infants', 'Suitable for children', 'Pets allowed']),

                'previous_status' => 'completed',
                'status' => 'completed',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        // Insert data into the seekers table
        DB::table('non_swaps')->insert($properties);
    }
}
