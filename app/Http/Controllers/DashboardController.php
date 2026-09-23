<?php

namespace App\Http\Controllers;

use App\Models\Visit;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isDoctor()) {
            $waitingList = Visit::with(['patient', 'triage'])
                ->inWaitingList()
                ->latest('visit_date')
                ->get();

            return view('dashboard.index', [
                'waitingList' => $waitingList,
                'waitingCount' => $waitingList->count(),
            ]);
        }

        $today = Visit::with(['patient', 'triage', 'consultation'])
            ->whereDate('visit_date', today())
            ->latest('visit_date')
            ->get();

        return view('dashboard.index', [
            'todayVisits' => $today,
            'todayCount' => $today->count(),
            'waitingCount' => Visit::inWaitingList()->count(),
            'completedCount' => Visit::where('completed', true)->count(),
        ]);
    }
}
