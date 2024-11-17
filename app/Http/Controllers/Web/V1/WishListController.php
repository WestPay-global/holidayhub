<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WishList;

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

            if (isset($request->home_swap_id)) {
                $wishList = WishList::where('created_by', $user->id)->where('home_swap_id', $request->home_swap_id)->first();
            }
            if (isset($request->non_swap_id)) {
                $wishList = WishList::where('created_by', $user->id)->where('non_swap_id', $request->non_swap_id)->first();
            }

            // $wishList = WishList::where('created_by', $user->id)
            // ->when(isset($request->home_swap_id), function ($query) use ($request) {
            //     $query->where('home_swap_id', $request->home_swap_id);
            // })
            // ->orWhere('non_swap_id', $request->non_swap_id)
            // ->first();

            if ($wishList) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item already exists in wishlist',
                ]);
            }

            $wishList = new WishList();
            $wishList->created_by = $user->id;
            $wishList->list_type = $request->list_type; //homeswap, nonswap
            $wishList->non_swap_id = $request->non_swap_id ? $request->non_swap_id : null;
            $wishList->home_swap_id = $request->home_swap_id ? $request->home_swap_id : null;
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
