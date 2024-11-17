<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\HomeSwap;
use App\Models\NonSwap;
use App\Models\Message;

class ListOfferController extends Controller
{
    /**
     * offer An Exchange.
     */
    public function offerAnExchange(Request $request, $list_id)
    {
        try {
            $user = Auth::user();

            $listType = $request->list_type; //hidden field
            $list = $listType == 'homeswap' ? HomeSwap::findOrFail($list_id) : NonSwap::findOrFail($list_id);

            //u cannot make-offer on ur own list
            if ($list->created_by == $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => "Unauthorized process",
                ]);
            }

            $offerExists = ListOffer::where(['list_id' => $list->id, 'seeker_id' => $user->id])->first();

            if ($offerExists) {
                return response()->json([
                    'success' => false,
                    'message' => "You've already made offer for this list",
                ]);
            }

            $data = $request->all();

            $listOffer = new ListOffer();
            $listOffer->owner_id = $list->created_by;
            $listOffer->seeker_id = $user->id;
            $listOffer->list_id = $list->id;
            $listOffer->list_type = $listType;
            $listOffer->check_in = $request->check_in;
            $listOffer->check_out = $request->check_out;

            // Normalize date inputs to Y-m-d using Carbon
            $listOffer->check_in = $request->check_in ? Carbon::parse($request->check_in)->format('Y-m-d') : null;
            $listOffer->check_out = $request->check_out ? Carbon::parse($request->check_out)->format('Y-m-d') : null;

            $listOffer->exchange_type = $request->exchange_type;

            $listOffer->no_of_adults = (int) $request->no_of_adults > 0 ? (int) $request->no_of_adults : 0;
            $listOffer->no_of_children = (int) $request->no_of_children > 0 ? (int) $request->no_of_children : 0;
            $listOffer->no_of_infants = (int) $request->no_of_infants > 0 ? $request->no_of_infants : 0;

            $listOffer->initial_message = $request->initial_message ? $request->initial_message : null;

            $listOffer->save();

            $message = Message::create([
                'date_time' => now(),
                'sender_id' => $user->id,
                'receiver_id' => $list->created_by,

                'list_id' => $list->id,
                'list_offer_id' => $listOffer->id,
                'message' => $request->initial_message,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Offer Made Successfully',
                'data' => $listOffer
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
