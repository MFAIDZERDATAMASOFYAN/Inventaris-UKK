<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index() {
        $data = array(
            "title" => "Inventaris Data Laptop",
            "menudashboard" => "active",
        );

        return view('dashboard', $data);
    }
}
