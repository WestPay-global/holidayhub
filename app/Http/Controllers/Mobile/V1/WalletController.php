<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;


class WalletController extends Controller
{
    public function getBalance()
    {
        $user = Auth::user();
        $balance = Wallet::where('user_id', $user->id)
            ->selectRaw('SUM(CASE WHEN type = "earning" THEN amount ELSE -amount END) as balance')
            ->value('balance') ?? 0;

        return response()->json([
            'success' => true,
            'balance' => $balance,
        ]);
    }

    // Add an earning
    public function addEarnings(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();

        Wallet::create([
            'user_id' => $user->id,
            'type' => 'earning',
            'amount' => $request->amount,
            'description' => $request->description ?? 'Earning added',
        ]);

        return $this->getBalance();
    }

    // Process a payout
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();

        $balance = Wallet::where('user_id', $user->id)
            ->selectRaw('SUM(CASE WHEN type = "earning" THEN amount ELSE -amount END) as balance')
            ->value('balance') ?? 0;

        if ($balance < $request->amount) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance'], 400);
        }

        Wallet::create([
            'user_id' => $user->id,
            'type' => 'payout',
            'amount' => $request->amount,
            'description' => $request->description ?? 'Payout processed',
        ]);

        return $this->getBalance();
    }
}
