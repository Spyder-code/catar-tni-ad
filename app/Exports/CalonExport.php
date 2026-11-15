<?php

namespace App\Exports;

use App\Models\Calon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CalonExport implements FromView, WithCustomCsvSettings
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

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ";"
        ];
    }
}
