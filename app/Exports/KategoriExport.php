<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KategoriExport implements FromView
{
    protected $kategori;

    public function __construct($kategori)
    {
        $this->kategori = $kategori;
    }

    public function view(): View
    {
        return view('admin.kategori.excel', [
            'kategori' => $this->kategori
        ]);
    }
}