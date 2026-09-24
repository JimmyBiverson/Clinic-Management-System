<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Prescription;
use App\Models\User;
use App\Models\Visit;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home', [
            'totalPatients' => Patient::count(),
            'totalVisits' => Visit::count(),
            'totalPrescriptions' => Prescription::count(),
            'totalDoctors' => User::where('role', 'doctor')->count(),
        ]);
    }

    public function doctors()
    {
        return view('frontend.doctors');
    }

    public function doctor($id = 1)
    {
        return view('frontend.doctor', ['doctorId' => $id]);
    }

    public function department($id = 1)
    {
        return view('frontend.department', ['departmentId' => $id]);
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function appointment()
    {
        return view('frontend.appointment');
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function login()
    {
        return view('frontend.login');
    }
}
