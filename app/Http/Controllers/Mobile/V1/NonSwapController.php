<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\NonSwap;

class NonSwapController extends Controller
{
    public function allNonSwap()
    {
        $perPage = 30; // Adjust perPage value as needed

        $nonSwaps = NonSwap::with('creator')->orderBy('id', 'desc')->paginate($perPage);
        return response()->json([
            'success' => true,
            'data' => $nonSwaps
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function singleNonSwap($id)
    {
        try {
            $user = Auth::user();

            $nonSwap = NonSwap::with('createdBy')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $nonSwap,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function myAllNonSwap()
    {
        $user = Auth::user();
        $perPage = 30; // Adjust perPage value as needed

        $nonSwaps = NonSwap::with('createdBy')->where('created_by', $user->id)->orderBy('id', 'desc')->paginate($perPage);
        return response()->json([
            'success' => true,
            'data' => $nonSwaps
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        try {
            //code...
            $nonSwap = NonSwap::where('created_by', $user->id)->latest()->first();

            if ($nonSwap && $nonSwap->status == 'draft') {

                $nonSwap->created_by = $user->id;
                $nonSwap->seeker_id = null;

                $nonSwap->describe_place_features = !empty($data['describe_place_features']) ? json_encode($data['describe_place_features']) : null;

                $nonSwap->what_place_offer_visitors = !empty($data['what_place_offer_visitors']) ? json_encode($data['what_place_offer_visitors']) : null;

                $nonSwap->place_latitude = $data['place_latitude'] ?? null;
                $nonSwap->place_longitude = $data['place_longitude'] ?? null;
                $nonSwap->place_city = $data['place_city'] ?? null;
                $nonSwap->place_state = $data['place_state'] ?? null;
                $nonSwap->place_country = $data['place_country'] ?? null;
                $nonSwap->place_address = $data['place_address'] ?? null;

                $nonSwap->guests = $data['guests'] ?? null;
                $nonSwap->bedrooms = $data['bedrooms'] ?? null;
                $nonSwap->beds = $data['beds'] ?? null;
                $nonSwap->bathrooms = $data['bathrooms'] ?? null;

                $nonSwap->what_place_has_to_offer = !empty($data['what_place_has_to_offer']) ? json_encode($data['what_place_has_to_offer']) : null;

                $nonSwap->place_pictures = !empty($data['place_pictures']) ? json_encode($data['place_pictures']) : null;

                $nonSwap->house_precise_title = $data['house_precise_title'] ?? null;
                $nonSwap->best_describe_your_place = !empty($data['best_describe_your_place']) ? json_encode($data['best_describe_your_place']) : null;

                $nonSwap->describe_house_in_detail = $data['describe_house_in_detail'] ?? null;

                $nonSwap->rent_per_night = (float) $data['rent_per_night'] ?? null;
                $nonSwap->cleaning_fee = (float) $data['cleaning_fee'] ?? null;
                $nonSwap->pet_fee = (float) $data['pet_fee'] ?? null;

                $nonSwap->available_window_start_date = $data['available_window_start_date'] ?? null;
                $nonSwap->available_window_end_date = $data['available_window_end_date'] ?? null;
                $nonSwap->minimum_stay_duration = $data['minimum_stay_duration'] ?? null;
                $nonSwap->maximum_stay_duration = $data['maximum_stay_duration'] ?? null;

                $nonSwap->set_rules = !empty($data['set_rules']) ? json_encode($data['set_rules']) : null;

                $nonSwap->save();

            } else {

                $nonSwap = new NonSwap();
                $nonSwap->created_by = $user->id;
                $nonSwap->seeker_id = null;

                $nonSwap->describe_place_features = !empty($data['describe_place_features']) ? json_encode($data['describe_place_features']) : null;

                $nonSwap->what_place_offer_visitors = !empty($data['what_place_offer_visitors']) ? json_encode($data['what_place_offer_visitors']) : null;

                $nonSwap->place_latitude = $data['place_latitude'] ?? null;
                $nonSwap->place_longitude = $data['place_longitude'] ?? null;
                $nonSwap->place_city = $data['place_city'] ?? null;
                $nonSwap->place_state = $data['place_state'] ?? null;
                $nonSwap->place_country = $data['place_country'] ?? null;
                $nonSwap->place_address = $data['place_address'] ?? null;

                $nonSwap->guests = $data['guests'] ?? null;
                $nonSwap->bedrooms = $data['bedrooms'] ?? null;
                $nonSwap->beds = $data['beds'] ?? null;
                $nonSwap->bathrooms = $data['bathrooms'] ?? null;

                $nonSwap->what_place_has_to_offer = !empty($data['what_place_has_to_offer']) ? json_encode($data['what_place_has_to_offer']) : null;

                $nonSwap->place_pictures = !empty($data['place_pictures']) ? json_encode($data['place_pictures']) : null;

                $nonSwap->house_precise_title = $data['house_precise_title'] ?? null;
                $nonSwap->best_describe_your_place = !empty($data['best_describe_your_place']) ? json_encode($data['best_describe_your_place']) : null;

                $nonSwap->describe_house_in_detail = $data['describe_house_in_detail'] ?? null;

                $nonSwap->rent_per_night = (float) $data['rent_per_night'] ?? null;
                $nonSwap->cleaning_fee = (float) $data['cleaning_fee'] ?? null;
                $nonSwap->pet_fee = (float) $data['pet_fee'] ?? null;

                $nonSwap->available_window_start_date = $data['available_window_start_date'] ?? null;
                $nonSwap->available_window_end_date = $data['available_window_end_date'] ?? null;
                $nonSwap->minimum_stay_duration = $data['minimum_stay_duration'] ?? null;
                $nonSwap->maximum_stay_duration = $data['maximum_stay_duration'] ?? null;

                $nonSwap->set_rules = !empty($data['set_rules']) ? json_encode($data['set_rules']) : null;

                $nonSwap->save();

            }

            return response()->json([
                'success' => true,
                'message' => 'NonSwap Reservation record saved successfully',
                'data' => $nonSwap
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $user = Auth::user();

        try {
            $nonSwap = NonSwap::where(['id'=>$id, 'created_by'=>$user->id])->first();

            if (!$nonSwap) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorised Process',
                ]);
            }

            if (!empty($data['describe_place_features'])) {
                $nonSwap->describe_place_features = json_encode($data['describe_place_features']);
            }

            if (!empty($data['what_place_offer_visitors'])) {
                $nonSwap->what_place_offer_visitors = json_encode($data['what_place_offer_visitors']);
            }

            $nonSwap->place_latitude = $data['place_latitude'] ?? $nonSwap->place_latitude;
            $nonSwap->place_longitude = $data['place_longitude'] ?? $nonSwap->place_longitude;
            $nonSwap->place_city = $data['place_city'] ?? $nonSwap->place_city;
            $nonSwap->place_state = $data['place_state'] ?? $nonSwap->place_state;
            $nonSwap->place_country = $data['place_country'] ?? $nonSwap->place_country;
            $nonSwap->place_address = $data['place_address'] ?? $nonSwap->place_address;

            $nonSwap->guests = $data['guests'] ?? $nonSwap->guests;
            $nonSwap->bedrooms = $data['bedrooms'] ?? $nonSwap->bedrooms;
            $nonSwap->beds = $data['beds'] ?? $nonSwap->beds;
            $nonSwap->bathrooms = $data['bathrooms'] ?? $nonSwap->bathrooms;

            if (!empty($data['what_place_has_to_offer'])) {
                $nonSwap->what_place_has_to_offer = json_encode($data['what_place_has_to_offer']);
            }

            if (!empty($data['place_pictures'])) {
                $nonSwap->place_pictures = json_encode($data['place_pictures']);
            }

            $nonSwap->house_precise_title = $data['house_precise_title'] ?? $nonSwap->house_precise_title;
            if (!empty($data['best_describe_your_place'])) {
                $nonSwap->best_describe_your_place = json_encode($data['best_describe_your_place']);
            }

            $nonSwap->describe_house_in_detail = $data['describe_house_in_detail'] ?? $nonSwap->house_precise_title;

            $nonSwap->rent_per_night = (float) $data['rent_per_night'] ?? $nonSwap->rent_per_night;
            $nonSwap->cleaning_fee = (float) $data['cleaning_fee'] ?? $nonSwap->cleaning_fee;
            $nonSwap->pet_fee = (float) $data['pet_fee'] ?? $nonSwap->pet_fee;

            $nonSwap->available_window_start_date = $data['available_window_start_date'] ?? $nonSwap->available_window_start_date;
            $nonSwap->available_window_end_date = $data['available_window_end_date'] ?? $nonSwap->available_window_end_date;
            $nonSwap->minimum_stay_duration = $data['minimum_stay_duration'] ?? $nonSwap->minimum_stay_duration;
            $nonSwap->maximum_stay_duration = $data['maximum_stay_duration'] ?? $nonSwap->maximum_stay_duration;

            if (!empty($data['set_rules'])) {
                $nonSwap->set_rules = json_encode($data['set_rules']);
            }

            $nonSwap->previous_status = $nonSwap->status;
            $nonSwap->save();

            $nonSwap->save();

            return response()->json([
                'success' => true,
                'message' => 'NonSwap record updated successfully',
                'data' => $nonSwap
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
            $nonSwap = NonSwap::findOrFail($id);

            //u cannot publish what u didn't create
            if ($nonSwap->created_by !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => "Unauthorized process",
                ]);
            }

            if ($nonSwap->status == 'completed') {
                return response()->json([
                    'success' => true,
                    'message' => 'NonSwap already published',
                    'data' => $nonSwap
                ]);
            }

            $nonSwap->status = 'completed';
            $nonSwap->save();

            return response()->json([
                'success' => true,
                'message' => 'NonSwap published successfully',
                'data' => $nonSwap
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th
            ], 404);
        }
    }

    public function deactivateNonSwap(string $id)
    {
        $user = Auth::user();
        try {
            $nonSwap = NonSwap::where('id',$id)->where('created_by',$user->id)->first();
            if ($nonSwap) {
                $nonSwap->status = 'deactivated';
                $nonSwap->save();
                return response()->json(['success'=>true, 'message'=>'List Status Deactivated Successfully!', 'data'=>$nonSwap]);
            }
            return response()->json(['success'=>false, 'message'=>'Invalid Process']);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['success'=>false, 'message'=>'Something went wrong']);
        }

    }

    public function activateNonSwap(string $id)
    {
        $user = Auth::user();
        try {
            $nonSwap = NonSwap::where('id',$id)->where('created_by',$user->id)->first();
            if ($nonSwap) {
                $nonSwap->status = $nonSwap->previous_status;
                $nonSwap->save();
                return response()->json(['success'=>true, 'message'=>'Status Activated Successfully! Please contact admin for more details', 'data'=>$nonSwap]);
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
    public function deleteNonSwap($id)
    {
        $user = Auth::user();
        try {
            $nonSwap = NonSwap::where('id',$id)->where('created_by',$user->id)->first();
            if ($nonSwap) {
                $nonSwap->delete();
                return response()->json(['success'=>true, 'message'=>'Item List Deleted Successfully!']);
            }
            return response()->json(['success'=>false, 'message'=>'Invalid Process']);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['success'=>false, 'message'=>'Something went wrong']);
        }

    }
}
