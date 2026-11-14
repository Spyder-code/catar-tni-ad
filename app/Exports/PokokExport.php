<?php

namespace App\Exports;

use App\Models\Pokok;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class PokokExport extends StringValueBinder implements FromQuery, WithHeadings, WithMapping, WithCustomValueBinder
{
    private int $number = 0;

    public function __construct(private array $filters = [])
    {
    }

    public function query(): Builder
    {
        return Pokok::query()->filtered($this->filters)->orderBy('id');
    }

    public function headings(): array
    {
        return array_merge(['NO'], array_values(Pokok::EXCEL_COLUMNS));
    }

    public function map(mixed $pokok): array
    {
        $values = [];
        foreach (array_keys(Pokok::EXCEL_COLUMNS) as $column) {
            $values[] = $pokok->{$column};
        }

        return array_merge([++$this->number], $values);
    }
}
