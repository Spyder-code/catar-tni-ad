<?php

namespace App\Exports;

use App\Models\Calon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CalonExport implements FromView
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $data = Calon::all()->whereIn('id',$this->data);
        return view('export.calon', compact('data'));
    }
}
