<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;

class HomeController extends Controller
{
    /**
     * Show the application welcome view.
     */
    public function welcome()
    {
        $users = User::all();
        $attendances = Attendance::all();
        return view('welcome', compact('users', 'attendances'));
    }

    /**
     * Show the application dashboard view.
     * This is the main page of the application for the logged users.
     */
    public function index()
    {
        return view('dashboard');
    }
}
