<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $data = array(
            "title" => "Dashboard",
            "menudashboard" => "active",
        );

        return view('dashboard', $data);
    }
}
