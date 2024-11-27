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

        $homeSwaps = HomeSwap::with('createdBy')->orderBy('id', 'desc')->paginate($perPage);
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

            $homeSwap = HomeSwap::with('createdBy')->findOrFail($id);

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

    public function myAllHomeSwap()
    {
        $user = Auth::user();
        $perPage = 30; // Adjust perPage value as needed

        $homeSwaps = HomeSwap::with('createdBy')->where('created_by', $user->id)->orderBy('id', 'desc')->paginate($perPage);
        return response()->json([
            'success' => true,
            'data' => $homeSwaps
        ]);
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
                $homeSwap->seeker_id = null;

                $homeSwap->describe_place_features = !empty($data['describe_place_features']) ? json_encode($data['describe_place_features']) : null;

                $homeSwap->what_place_offer_visitors = !empty($data['what_place_offer_visitors']) ? json_encode($data['what_place_offer_visitors']) : null;

                $homeSwap->guests = $data['guests'] ?? null;
                $homeSwap->bedrooms = $data['bedrooms'] ?? null;
                $homeSwap->beds = $data['beds'] ?? null;
                $homeSwap->bathrooms = $data['bathrooms'] ?? null;

                $homeSwap->place_latitude = $data['place_latitude'] ?? null;
                $homeSwap->place_longitude = $data['place_longitude'] ?? null;
                $homeSwap->place_city = $data['place_city'] ?? null;
                $homeSwap->place_state = $data['place_state'] ?? null;
                $homeSwap->place_country = $data['place_country'] ?? null;
                $homeSwap->place_address = $data['place_address'] ?? null;

                $homeSwap->preferred_holiday_location_latitude = $data['preferred_holiday_location_latitude'] ?? null;
                $homeSwap->preferred_holiday_location_longitude = $data['preferred_holiday_location_longitude'] ?? null;
                $homeSwap->preferred_holiday_location_city = $data['preferred_holiday_location_city'] ?? null;
                $homeSwap->preferred_holiday_location_state = $data['preferred_holiday_location_state'] ?? null;
                $homeSwap->preferred_holiday_location_country = $data['preferred_holiday_location_country'] ?? null;
                $homeSwap->preferred_holiday_location_address = $data['preferred_holiday_location_address'] ?? null;

                $homeSwap->open_to_any_location = $data['open_to_any_location'] ?? false;

                $homeSwap->start_date_to_travel = $data['start_date_to_travel'] ? Carbon::parse($request->start_date_to_travel)->format('Y-m-d') : null;
                $homeSwap->end_date_to_travel = $data['end_date_to_travel'] ? Carbon::parse($request->end_date_to_travel)->format('Y-m-d') : null;

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

                // $homeSwap->has_homeswap = true;

                $homeSwap->save();

            } else {

                $homeSwap = new HomeSwap();
                $homeSwap->created_by = $user->id;
                $homeSwap->seeker_id = null;

                $homeSwap->describe_place_features = !empty($data['describe_place_features']) ? json_encode($data['describe_place_features']) : null;

                $homeSwap->what_place_offer_visitors = !empty($data['what_place_offer_visitors']) ? json_encode($data['what_place_offer_visitors']) : null;

                $homeSwap->guests = $data['guests'] ?? null;
                $homeSwap->bedrooms = $data['bedrooms'] ?? null;
                $homeSwap->beds = $data['beds'] ?? null;
                $homeSwap->bathrooms = $data['bathrooms'] ?? null;

                $homeSwap->place_latitude = $data['place_latitude'] ?? null;
                $homeSwap->place_longitude = $data['place_longitude'] ?? null;
                $homeSwap->place_city = $data['place_city'] ?? null;
                $homeSwap->place_state = $data['place_state'] ?? null;
                $homeSwap->place_country = $data['place_country'] ?? null;
                $homeSwap->place_address = $data['place_address'] ?? null;

                $homeSwap->preferred_holiday_location_latitude = $data['preferred_holiday_location_latitude'] ?? null;
                $homeSwap->preferred_holiday_location_longitude = $data['preferred_holiday_location_longitude'] ?? null;
                $homeSwap->preferred_holiday_location_city = $data['preferred_holiday_location_city'] ?? null;
                $homeSwap->preferred_holiday_location_state = $data['preferred_holiday_location_state'] ?? null;
                $homeSwap->preferred_holiday_location_country = $data['preferred_holiday_location_country'] ?? null;
                $homeSwap->preferred_holiday_location_address = $data['preferred_holiday_location_address'] ?? null;

                $homeSwap->open_to_any_location = $data['open_to_any_location'] ?? false;

                $homeSwap->start_date_to_travel = $data['start_date_to_travel'] ? Carbon::parse($request->start_date_to_travel)->format('Y-m-d') : null;
                $homeSwap->end_date_to_travel = $data['end_date_to_travel'] ? Carbon::parse($request->end_date_to_travel)->format('Y-m-d') : null;

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

                // $homeSwap->has_homeswap = true;

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

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $user = Auth::user();

        try {
            $homeSwap = HomeSwap::where(['id'=>$id, 'created_by'=>$user->id])->first();

            if (!$homeSwap) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorised Process',
                ]);
            }

            if (!empty($data['describe_place_features'])) {
                $homeSwap->describe_place_features = json_encode($data['describe_place_features']);
            }

            if (!empty($data['what_place_offer_visitors'])) {
                $homeSwap->what_place_offer_visitors = json_encode($data['what_place_offer_visitors']);
            }

            $homeSwap->guests = $data['guests'] ?? $homeSwap->guests;
            $homeSwap->bedrooms = $data['bedrooms'] ?? $homeSwap->bedrooms;
            $homeSwap->beds = $data['beds'] ?? $homeSwap->beds;
            $homeSwap->bathrooms = $data['bathrooms'] ?? $homeSwap->bathrooms;

            $homeSwap->place_latitude = $data['place_latitude'] ?? $homeSwap->place_latitude;
            $homeSwap->place_longitude = $data['place_longitude'] ?? $homeSwap->place_longitude;
            $homeSwap->place_city = $data['place_city'] ?? $homeSwap->place_city;
            $homeSwap->place_state = $data['place_state'] ?? $homeSwap->place_state;
            $homeSwap->place_country = $data['place_country'] ?? $homeSwap->place_country;
            $homeSwap->place_address = $data['place_address'] ?? $homeSwap->place_address;

            $homeSwap->preferred_holiday_location_latitude = $data['preferred_holiday_location_latitude'] ?? $homeSwap->preferred_holiday_location_latitude;
            $homeSwap->preferred_holiday_location_longitude = $data['preferred_holiday_location_longitude'] ?? $homeSwap->preferred_holiday_location_longitude;
            $homeSwap->preferred_holiday_location_city = $data['preferred_holiday_location_city'] ?? $homeSwap->preferred_holiday_location_city;
            $homeSwap->preferred_holiday_location_state = $data['preferred_holiday_location_state'] ?? $homeSwap->preferred_holiday_location_state;
            $homeSwap->preferred_holiday_location_country = $data['preferred_holiday_location_country'] ?? $homeSwap->preferred_holiday_location_country;
            $homeSwap->preferred_holiday_location_address = $data['preferred_holiday_location_address'] ?? $homeSwap->preferred_holiday_location_address;

            $homeSwap->open_to_any_location = $data['open_to_any_location'] ?? false;

            $homeSwap->start_date_to_travel = $data['start_date_to_travel'] ? Carbon::parse($request->start_date_to_travel)->format('Y-m-d') : null;
            $homeSwap->end_date_to_travel = $data['end_date_to_travel'] ? Carbon::parse($request->end_date_to_travel)->format('Y-m-d') : null;
            $homeSwap->swap_type = $data['swap_type'] ?? $homeSwap->swap_type;

            if (!empty($data['place_pictures'])) {
                $homeSwap->place_pictures = json_encode($data['place_pictures']);
            }

            $homeSwap->available_window_start_date = $data['available_window_start_date'] ?? $homeSwap->available_window_start_date;
            $homeSwap->available_window_end_date = $data['available_window_end_date'] ?? $homeSwap->available_window_end_date;
            $homeSwap->minimum_stay_duration = $data['minimum_stay_duration'] ?? $homeSwap->minimum_stay_duration;
            $homeSwap->maximum_stay_duration = $data['maximum_stay_duration'] ?? $homeSwap->maximum_stay_duration;

            $homeSwap->rent_per_night = (float) $data['rent_per_night'] ?? $homeSwap->rent_per_night;
            $homeSwap->cleaning_fee = (float) $data['cleaning_fee'] ?? $homeSwap->cleaning_fee;
            $homeSwap->pet_fee = (float) $data['pet_fee'] ?? $homeSwap->pet_fee;

            $homeSwap->short_decsription = $data['short_decsription'] ?? $homeSwap->short_decsription;

            $homeSwap->what_you_will_love_about_home = $data['what_you_will_love_about_home'] ?? $homeSwap->what_you_will_love_about_home;
            $homeSwap->what_you_will_love_about_neighbourhood = $data['what_you_will_love_about_neighbourhood'] ?? $homeSwap->what_you_will_love_about_neighbourhood;
            $homeSwap->additional_information = $data['additional_information'] ?? $homeSwap->additional_information;

            if (!empty($data['set_rules'])) {
                $homeSwap->set_rules = json_encode($data['set_rules']);
            }

            $homeSwap->previous_status = $homeSwap->status;
            $homeSwap->save();


            return response()->json([
                'success' => true,
                'message' => 'HomeSwap record updated successfully',
                'data' => $homeSwap
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function publish(string $id) {
        $user = Auth::user();
        try {
            $homeSwap = HomeSwap::findOrFail($id);

            //u cannot publish what u didn't create
            if ($homeSwap->created_by !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => "Unauthorized process",
                ]);
            }

            if ($homeSwap->status == 'completed') {
                return response()->json([
                    'success' => true,
                    'message' => 'HomeSwap already published',
                    'data' => $homeSwap
                ]);
            }

            $homeSwap->status = 'completed';
            $homeSwap->save();

            return response()->json([
                'success' => true,
                'message' => 'HomeSwap published successfully',
                'data' => $homeSwap
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th
            ], 404);
        }
    }

    public function deactivateHomeSwap(string $id)
    {
        $user = Auth::user();
        try {
            $homeSwap = HomeSwap::where('id',$id)->where('created_by',$user->id)->first();
            if ($homeSwap) {
                $homeSwap->status = 'deactivated';
                $homeSwap->save();
                return response()->json(['success'=>true, 'message'=>'List Status Deactivated Successfully!', 'data'=>$homeSwap]);
            }
            return response()->json(['success'=>false, 'message'=>'Invalid Process']);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['success'=>false, 'message'=>'Something went wrong']);
        }

    }

    public function activateHomeSwap(string $id)
    {
        $user = Auth::user();
        try {
            $homeSwap = HomeSwap::where('id',$id)->where('created_by',$user->id)->first();
            if ($homeSwap) {
                $homeSwap->status = $homeSwap->previous_status;
                $homeSwap->save();
                return response()->json(['success'=>true, 'message'=>'Status Activated Successfully! Please contact admin for more details', 'data'=>$homeSwap]);
            }
            return response()->json(['success'=>false, 'message'=>'Invalid Process']);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['success'=>false, 'message'=>'Something went wrong']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteHomeSwap($id)
    {
        $user = Auth::user();
        try {
            $homeSwap = HomeSwap::where('id',$id)->where('created_by',$user->id)->first();
            if ($homeSwap) {
                $homeSwap->delete();
                return response()->json(['success'=>true, 'message'=>'Item List Deleted Successfully!']);
            }
            return response()->json(['success'=>false, 'message'=>'Invalid Process']);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['success'=>false, 'message'=>'Something went wrong']);
        }

    }
}
