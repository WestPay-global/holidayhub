<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\WishList;
use App\Models\HomeSwap;
use App\Models\NonSwap;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        $user = Auth::user();
        $all = WishList::where('created_by', $user->id)->get();
        return response()->json([
            'success' => true,
            'data' => $all
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            $listType = $request->list_type; //hidden field
            $list = $listType == 'homeswap' ? HomeSwap::findOrFail($request->list_id) : NonSwap::findOrFail($request->list_id);

            //u cannot make-offer on ur own list
            if ($list->created_by == $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => "Unauthorized process",
                ]);
            }

            $wishList = WishList::where('created_by', $user->id)->where('list_type', $request->list_type)->where('list_id', $request->list_id)->first();

            if ($wishList) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item already exists in wishlist',
                ]);
            }

            $wishList = new WishList();
            $wishList->created_by = $user->id;
            $wishList->list_type = $request->list_type; //homeswap, nonswap
            $wishList->list_id = $request->list_id;
            $wishList->save();

            return response()->json([
                'success' => true,
                'data' => $wishList,
                'message' => 'Wishlist saved successfully',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(string $id)
    {
        try {
            $wishList = WishList::findOrFail($id);
            $wishList->delete();
            return response()->json([
                'success' => true,
                'message' => 'Wish removed successfully'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
