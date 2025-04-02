<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SaleController extends Controller
{
    use AuthorizesRequests;

    /**
     * Simulate a sale and calculate commissions
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function simulateSale()
    {
        $user = auth()->user();
        
        DB::transaction(function () use ($user) {
            // Create sale with commission
            $sale = Sale::create([
                'user_id' => $user->id,
                'amount' => 1000, // Example amount
                'commission' => 100, // RM100 commission
                'referrer_commission' => $user->referrer ? 50 : 0 // RM50 for referrer
            ]);

            // Update user's commission
            $user->increment('total_commission', 100);

            // Update referrer's commission if exists
            if ($user->referrer) {
                $user->referrer->increment('total_commission', 50);
            }
        });

        return redirect()->back()->with('success', 'Sale simulated successfully! You earned RM100 commission.');
    }

    /**
     * Display the dashboard with user statistics
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = auth()->user();
        $totalCommission = $user->total_commission;
        $referralCode = $user->referral_code;
        $totalSales = $user->sales()->count();
        
        return view('dashboard', compact('totalCommission', 'referralCode', 'totalSales'));
    }
}
