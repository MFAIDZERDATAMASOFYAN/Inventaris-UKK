<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TugasExport implements FromView
{
    protected $tugas;

    public function __construct($tugas)
    {
        $this->tugas = $tugas;
    }

    public function view(): View
    {
        return view('admin.tugas.excel', [
            'tugas' => $this->tugas
        ]);
    }
}