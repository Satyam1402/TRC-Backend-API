<?php

namespace App\Http\Controllers\Api;

use App\Models\Property;
use App\Models\UserToken;
use Illuminate\Http\Request;
use App\Models\RentCollection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        try {
            $userToken = UserToken::where('token', $request->token)->first();

            if (!$userToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid token. Please login again.',
                ], 200);
            }

            $userId = $userToken->user_id;

            // Fetch the rent offset (total unpaid amount)
            $rentOffset = RentCollection::where('user_id', $userId)
                ->where('status', 'unpaid')
                ->sum('amount');

            // Fetch earned stars (for simplicity, assume 1 star per paid rent)
            $earnedStars = RentCollection::where('user_id', $userId)
                ->where('status', 'paid')
                ->count();

            // Fetch the next rent due date
            $nextRentDue = RentCollection::where('user_id', $userId)
                ->where('status', 'unpaid')
                ->orderBy('due_date', 'asc')
                ->first();
            $rentDueDate = $nextRentDue ? $nextRentDue->due_date->diffForHumans() : 'No pending rent';

            // Rent receipt and inspection report count
            $totalReceipts = RentCollection::where('user_id', $userId)->count();
            $totalReports = RentCollection::where('user_id', $userId)->whereNotNull('inspection_report')->count();
            $rentReceiptAndReport = "{$totalReports}/{$totalReceipts}";

            return response()->json([
                'status' => 'success',
                'rent_offset' => '$' . number_format($rentOffset, 2),
                'earned_stars' => "{$earnedStars} stars",
                'rent_due_date' => $rentDueDate,
                'rent_receipt_and_inspection_report' => $rentReceiptAndReport,
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch dashboard data.',
            ], 200);
        }
    }
}
