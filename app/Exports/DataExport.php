<?php

namespace App\Exports;

use App\Models\Calon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataExport implements FromView
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $data = Calon::with(['pendidikan', 'wali', 't2020', 't2019', 'pokok'])
            ->whereIn('id', $this->data)
            ->get();
        return view('export.calon', compact('data'));
    }

}
