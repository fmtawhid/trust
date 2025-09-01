<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LanguageValueExport implements FromCollection, WithHeadings, WithStyles
{
    private $translations;
    private $locale;

    public function __construct(array $translations, string $locale)
    {
        $this->translations = $translations;
        $this->locale = $locale;
    }

    public function collection(): Collection
    {
        $rows = [];

        foreach ($this->translations as $key => $value) {
            $rows[] = [
                'key' => $key,
                $this->locale => $value,
            ];
        }

        return collect($rows);
    }

    public function headings(): array
    {
        return ['key', $this->locale];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:B1')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00'], // Yellow
            ],
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
