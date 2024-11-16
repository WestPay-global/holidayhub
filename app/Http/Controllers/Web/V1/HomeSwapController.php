<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\HomeSwap;

class HomeSwapController extends Controller
{
    public function allHomeSwap()
    {
        $perPage = 30; // Adjust perPage value as needed

        $homeSwaps = HomeSwap::orderBy('id', 'desc')->paginate($perPage);
        return response()->json([
            'success' => true,
            'data' => $homeSwaps
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function singleHomeSwap($id)
    {
        try {
            $user = Auth::user();

            $homeSwap = HomeSwap::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => $homeSwap,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        try {
            //code...
            $homeSwap = HomeSwap::where('created_by', $user->id)->latest()->first();

            if ($homeSwap && $homeSwap->status == 'draft') {

                $homeSwap->created_by = $user->id;
                $homeSwap->seeker_id = (int) $data['seeker_id'] ?? null;

                $homeSwap->decribe_place_features = !empty($data['decribe_place_features']) ? json_encode($data['decribe_place_features']) : null;

                $homeSwap->what_place_offer = !empty($data['what_place_offer']) ? json_encode($data['what_place_offer']) : null;

                $homeSwap->bedrooms = $data['bedrooms'] ?? null;
                $homeSwap->beds = $data['beds'] ?? null;
                $homeSwap->bathrooms = $data['bathrooms'] ?? null;

                $homeSwap->place_latitude = $data['place_latitude'] ?? null;
                $homeSwap->place_longitude = $data['place_longitude'] ?? null;
                $homeSwap->place_city = $data['place_city'] ?? null;
                $homeSwap->place_state = $data['place_state'] ?? null;
                $homeSwap->place_country = $data['place_country'] ?? null;
                $homeSwap->place_address = $data['place_address'] ?? null;

                $homeSwap->preferred_location_latitude = $data['preferred_location_latitude'] ?? null;
                $homeSwap->preferred_location_longitude = $data['preferred_location_longitude'] ?? null;
                $homeSwap->preferred_location_city = $data['preferred_location_city'] ?? null;
                $homeSwap->preferred_location_state = $data['preferred_location_state'] ?? null;
                $homeSwap->preferred_location_country = $data['preferred_location_country'] ?? null;
                $homeSwap->preferred_location_address = $data['preferred_location_address'] ?? null;

                $homeSwap->date_available = $data['date_available'] ?? null;
                $homeSwap->swap_type = $data['swap_type'] ?? null;

                $homeSwap->place_pictures = !empty($data['place_pictures']) ? json_encode($data['place_pictures']) : null;

                $homeSwap->available_window_start_date = $data['available_window_start_date'] ?? null;
                $homeSwap->available_window_end_date = $data['available_window_end_date'] ?? null;
                $homeSwap->minimum_stay_duration = $data['minimum_stay_duration'] ?? null;
                $homeSwap->maximum_stay_duration = $data['maximum_stay_duration'] ?? null;

                $homeSwap->rent_per_night = (float) $data['rent_per_night'] ?? null;
                $homeSwap->cleaning_fee = (float) $data['cleaning_fee'] ?? null;
                $homeSwap->pet_fee = (float) $data['pet_fee'] ?? null;

                $homeSwap->short_decsription = $data['short_decsription'] ?? null;

                $homeSwap->what_you_will_love_about_home = $data['what_you_will_love_about_home'] ?? null;
                $homeSwap->what_you_will_love_about_neighbourhood = $data['what_you_will_love_about_neighbourhood'] ?? null;
                $homeSwap->additional_information = $data['additional_information'] ?? null;

                $homeSwap->set_rules = !empty($data['set_rules']) ? json_encode($data['set_rules']) : null;

                $homeSwap->save();

            } else {

                $homeSwap = new HomeSwap();
                $homeSwap->created_by = $user->id;
                $homeSwap->seeker_id = (int) $data['seeker_id'] ?? null;

                $homeSwap->decribe_place_features = !empty($data['decribe_place_features']) ? json_encode($data['decribe_place_features']) : null;

                $homeSwap->what_place_offer = !empty($data['what_place_offer']) ? json_encode($data['what_place_offer']) : null;

                $homeSwap->bedrooms = $data['bedrooms'] ?? null;
                $homeSwap->beds = $data['beds'] ?? null;
                $homeSwap->bathrooms = $data['bathrooms'] ?? null;

                $homeSwap->place_latitude = $data['place_latitude'] ?? null;
                $homeSwap->place_longitude = $data['place_longitude'] ?? null;
                $homeSwap->place_city = $data['place_city'] ?? null;
                $homeSwap->place_state = $data['place_state'] ?? null;
                $homeSwap->place_country = $data['place_country'] ?? null;
                $homeSwap->place_address = $data['place_address'] ?? null;

                $homeSwap->preferred_location_latitude = $data['preferred_location_latitude'] ?? null;
                $homeSwap->preferred_location_longitude = $data['preferred_location_longitude'] ?? null;
                $homeSwap->preferred_location_city = $data['preferred_location_city'] ?? null;
                $homeSwap->preferred_location_state = $data['preferred_location_state'] ?? null;
                $homeSwap->preferred_location_country = $data['preferred_location_country'] ?? null;
                $homeSwap->preferred_location_address = $data['preferred_location_address'] ?? null;

                $homeSwap->date_available = $data['date_available'] ?? null;
                $homeSwap->swap_type = $data['swap_type'] ?? null;

                $homeSwap->place_pictures = !empty($data['place_pictures']) ? json_encode($data['place_pictures']) : null;

                $homeSwap->available_window_start_date = $data['available_window_start_date'] ?? null;
                $homeSwap->available_window_end_date = $data['available_window_end_date'] ?? null;
                $homeSwap->minimum_stay_duration = $data['minimum_stay_duration'] ?? null;
                $homeSwap->maximum_stay_duration = $data['maximum_stay_duration'] ?? null;

                $homeSwap->rent_per_night = (float) $data['rent_per_night'] ?? null;
                $homeSwap->cleaning_fee = (float) $data['cleaning_fee'] ?? null;
                $homeSwap->pet_fee = (float) $data['pet_fee'] ?? null;

                $homeSwap->short_decsription = $data['short_decsription'] ?? null;

                $homeSwap->what_you_will_love_about_home = $data['what_you_will_love_about_home'] ?? null;
                $homeSwap->what_you_will_love_about_neighbourhood = $data['what_you_will_love_about_neighbourhood'] ?? null;
                $homeSwap->additional_information = $data['additional_information'] ?? null;

                $homeSwap->set_rules = !empty($data['set_rules']) ? json_encode($data['set_rules']) : null;

                $homeSwap->save();

            }

            return response()->json([
                'success' => true,
                'message' => 'HomeSwap record saved successfully',
                'data' => $homeSwap
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
