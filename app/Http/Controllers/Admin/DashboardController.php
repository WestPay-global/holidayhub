<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use Exception;

use App\Models\User;
use App\Models\HomeSwap;
use App\Models\NonSwap;
use App\Models\WishList;
use App\Models\ListOffer;

class DashboardController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function loginPost(Request $request)
    {
        $rules = array(
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        );
        $messages = [
            'email.required' => '* Your Email is required',
            'email.string' => '* Invalid Characters',
            'email.email' => '* Must be of Email format with \'@\' symbol',
            'email.exists' => '* Invalid Credentials',

            'password.required'   => 'This field is required',
            'password.string'   => 'Email does not exist',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $user = User::where('email',$request->email)->first();
            if($user->status !== 'superadmin'){
                return back()->with('error', 'Unauthorised Process');
            }

            $credentials = $request->only('email', 'password');
            $check = Auth::guard('web')->attempt($credentials);
            if (!$check) {
                return back()->with('error', 'Invalid email or password, please check your credentials and try again');
            }
            $user = Auth::getProvider()->retrieveByCredentials($credentials); //full user details

            // if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            //     return redirect()->intended('/admin');
            // }

            // $user->save();
            Auth::guard('web')->login($user);

            return redirect()->route('adminDashboard');
        }
    }
    public function adminDashboard()
    {
        $users = User::count();
        $homeSwapUsers = HomeSwap::distinct('created_by')->count();
        $nonSwapUsers = NonSwap::distinct('created_by')->count();

        $wishlists = WishList::count();

        $homeSwaps = HomeSwap::count();
        $draftHomeSwaps = HomeSwap::where('status','draft')->count();
        $completedHomeSwaps = HomeSwap::where('status','completed')->count();
        $deactivatedHomeSwaps = HomeSwap::where('status','deactivated')->count();
        $suspendedHomeSwaps = HomeSwap::where('status','suspended')->count();

        $nonSwaps = NonSwap::count();
        $draftNonSwaps = NonSwap::where('status','draft')->count();
        $completedNonSwaps = NonSwap::where('status','completed')->count();
        $deactivatedNonSwaps = NonSwap::where('status','deactivated')->count();
        $suspendedNonSwaps = NonSwap::where('status','suspended')->count();

        $listOffers = ListOffer::count();
        $listOfferPending = ListOffer::where('status', 'pending')->count();
        $listOfferUpcoming = ListOffer::where('status', 'upcoming')->count();
        $listOfferCancelled = ListOffer::where('status', 'cancelled')->count();
        $listOfferCompleted = ListOffer::where('status', 'completed')->count();

        return view('backend.dashboard', compact('users', 'homeSwapUsers', 'nonSwapUsers', 'wishlists',
        'homeSwaps', 'draftHomeSwaps', 'completedHomeSwaps', 'deactivatedHomeSwaps', 'suspendedHomeSwaps',
        'nonSwaps', 'draftNonSwaps', 'completedNonSwaps', 'deactivatedNonSwaps', 'suspendedNonSwaps',
        'listOffers', 'listOfferPending', 'listOfferUpcoming', 'listOfferCancelled', 'listOfferCompleted'
        ));
    }

    public function allUser($list_type="")
    {
        if ($list_type=="") {
            $users = User::all();
        }
        if ($list_type=="swap") {
            $users = User::where('has_homeswap', true)->get();
        }
        if ($list_type=="reservation") {
            $users = User::where('has_nonswap', true)->get();
        }

        $allStatus = [
            ['name'=>'approved', 'bgColor'=>'success'],
            ['name'=>'pending', 'bgColor'=>'primary'],
            ['name'=>'suspended', 'bgColor'=>'danger'],
        ];

        return view('backend.user.allUser', compact('users', 'allStatus', 'list_type'));
    }

    public function singleUser($user_id)
    {
        $user = User::with(['homeSwaps', 'nonSwaps'])->where('id',$user_id)->first();

        $allStatus = [
            ['name'=>'approved', 'bgColor'=>'success'],
            ['name'=>'pending', 'bgColor'=>'primary'],
            ['name'=>'suspended', 'bgColor'=>'danger'],
        ];

        return view('backend.user.singleUser', compact('user', 'allStatus'));
    }

    public function allHomeSwap($status="")
    {
        if ($status=="") {
            $listings = HomeSwap::all();
        }
        if ($status=="draft") {
            $listings = HomeSwap::where('status', 'draft')->get();
        }
        if ($status=="completed") {
            $listings = HomeSwap::where('status', 'completed')->get();
        }
        if ($status=="deactivated") {
            $listings = HomeSwap::where('status', 'deactivated')->get();
        }
        if ($status=="suspended") {
            $listings = HomeSwap::where('status', 'suspended')->get();
        }

        $allStatus = [
            ['name'=>'draft', 'bgColor'=>'primary'],
            ['name'=>'completed', 'bgColor'=>'success'],
            ['name'=>'deactivated', 'bgColor'=>'dark'],
            ['name'=>'suspended', 'bgColor'=>'danger'],
        ];

        return view('backend.homeswap.allHomeSwap', compact('listings', 'allStatus', 'status'));
    }

    public function singleHomeSwap($list_id)
    {
        //i want to add another attribute 'seeker' in the listOffers, how can I do it
        $homeSwap = HomeSwap::with(['createdBy', 'seeker', 'listOffers.owner', 'listOffers.seeker'])->where('id',$list_id)->first();
        $describePlaceFeatures = $homeSwap->describe_place_features ? json_decode($homeSwap->describe_place_features) : null;
        $whatPlaceOfferVisitors = $homeSwap->what_place_offer_visitors ? json_decode($homeSwap->what_place_offer_visitors) : null;

        $allStatus = [
            ['name'=>'draft', 'bgColor'=>'primary'],
            ['name'=>'completed', 'bgColor'=>'success'],
            ['name'=>'deactivated', 'bgColor'=>'dark'],
            ['name'=>'suspended', 'bgColor'=>'danger']
        ];

        return view('backend.homeswap.singleHomeSwap', compact('homeSwap', 'allStatus', 'describePlaceFeatures', 'whatPlaceOfferVisitors'));
    }

    public function allNonSwap($status="")
    {
        if ($status=="") {
            $listings = NonSwap::all();
        }
        if ($status=="draft") {
            $listings = NonSwap::where('status', 'draft')->get();
        }
        if ($status=="completed") {
            $listings = NonSwap::where('status', 'completed')->get();
        }
        if ($status=="deactivated") {
            $listings = NonSwap::where('status', 'deactivated')->get();
        }
        if ($status=="suspended") {
            $listings = NonSwap::where('status', 'suspended')->get();
        }

        $allStatus = [
            ['name'=>'pending', 'bgColor'=>'primary'],
            ['name'=>'completed', 'bgColor'=>'success'],
            ['name'=>'cancelled', 'bgColor'=>'dark'],
            ['name'=>'suspended', 'bgColor'=>'danger'],
        ];

        return view('backend.nonswap.allNonSwap', compact('listings', 'allStatus', 'status'));
    }

    public function singleNonSwap($list_id)
    {
        //i want to add another attribute 'seeker' in the listOffers, how can I do it
        $nonSwap = NonSwap::with(['createdBy', 'seeker', 'listOffers.owner', 'listOffers.seeker'])->where('id',$list_id)->first();
        $describePlaceFeatures = $nonSwap->describe_place_features ? json_decode($nonSwap->describe_place_features) : null;
        $whatPlaceOfferVisitors = $nonSwap->what_place_offer_visitors ? json_decode($nonSwap->what_place_offer_visitors) : null;

        $allStatus = [
            ['name'=>'draft', 'bgColor'=>'primary'],
            ['name'=>'completed', 'bgColor'=>'success'],
            ['name'=>'deactivated', 'bgColor'=>'dark'],
            ['name'=>'suspended', 'bgColor'=>'danger']
        ];

        return view('backend.nonswap.singleNonSwap', compact('nonSwap', 'allStatus', 'describePlaceFeatures', 'whatPlaceOfferVisitors'));
    }

    //////////////////

    public function allOffer($status="")
    {
        if ($status=="") {
            $listOffers = ListOffer::with(['owner','seeker'])->get();
        } else {
            $listOffers = ListOffer::with(['owner','seeker'])->where('status',$status)->get();
        }

        $allStatus = [
            ['name'=>'pending', 'bgColor'=>'primary'],
            ['name'=>'upcoming', 'bgColor'=>'info'],
            ['name'=>'completed', 'bgColor'=>'success'],
            ['name'=>'cancelled', 'bgColor'=>'dark'],
        ];

        return view('backend.offers.allListOffer', compact('listOffers', 'allStatus', 'status'));
    }

    public function singleOffer($list_id)
    {
        //i want to add another attribute 'seeker' in the listOffers, how can I do it
       $offer = ListOffer::where('id',$list_id)->first();
       if ($offer->list_type=='homeswap') {
            $offer = ListOffer::with(['homeswaplist', 'owner','seeker'])->where('id',$list_id)->first();
       } else {
           $offer = ListOffer::with(['nonswaplist', 'owner','seeker'])->where('id',$list_id)->first();
       }

        $allStatus = [
            ['name'=>'pending', 'bgColor'=>'primary'],
            ['name'=>'upcoming', 'bgColor'=>'info'],
            ['name'=>'completed', 'bgColor'=>'success'],
            ['name'=>'cancelled', 'bgColor'=>'dark'],
        ];

        return view('backend.offers.singleListOffer', compact('offer', 'allStatus'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
