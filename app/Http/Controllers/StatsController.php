<?php

namespace App\Http\Controllers;

use App\Models\ArchivedContract;
use App\Models\Contract;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function overview()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $users_count = User::count();
            $open_visit_requests_count = Ticket::where('status', 'open')->count();
            $revenues = Contract::where('is_paid', '1')->sum('total_price') + ArchivedContract::sum('total_price') + Ticket::count() * 750;
            $all_contracts = Contract::count() + ArchivedContract::count();
            $unpaid_contracts = Contract::where('is_paid', '0')->count();
            $contracts_expire_soon = Contract::where('expiry_date', '<',  now()->addDays(10))->count();
            $expired_contracts =
                Contract::where('expiry_date', '<',  now())->count();

            return response()->json([
                'users' => $users_count,
                'requests' => $open_visit_requests_count,
                'revenues' => $revenues,
                'contracts' => $all_contracts,
                'unpaid_contracts' => $unpaid_contracts,
                'expiring_contracts' => $contracts_expire_soon,
                'expired_contracts' => $expired_contracts
            ], 200);
        }
    }

    public function sales()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {

            $contractsPerMonth = Contract::selectRaw('SUM(id) as total, MONTH(created_at) as month')
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('total', 'month');

            return response()->json($contractsPerMonth);
        }
    }
    public function contracts()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {

            $contractsPerMonth = Contract::selectRaw('count(id) as total, MONTH(created_at) as month')
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('total', 'month');

            return response()->json($contractsPerMonth);
        }
    }
    public function requests()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {

            $ticketsPerMonth = Ticket::selectRaw('count(id) as total, MONTH(created_at) as month')
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('total', 'month');

            return response()->json($ticketsPerMonth);
        }
    }
}
