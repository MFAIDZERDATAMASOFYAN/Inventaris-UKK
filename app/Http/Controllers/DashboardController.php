<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Tugas;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'total_user' => User::count(),
            'total_kategori' => Kategori::count(),
            'total_tugas' => Tugas::count(),
            'dipinjam' => Tugas::where('status', 'dipinjam')->count(),
            'pending' => Tugas::where('status', 'pending')->count(),
            'selesai' => Tugas::where('status', 'selesai')->count(),
            'total_stok' => Kategori::sum('jumlah'),
        ]);
    }
}
