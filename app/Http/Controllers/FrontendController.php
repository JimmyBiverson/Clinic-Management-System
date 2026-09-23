<?php

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home');
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
