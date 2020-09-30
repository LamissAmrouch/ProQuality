<?php

namespace App\Exports;

use App\Models\Fournisseur;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class FournisseursExport implements FromQuery,WithMapping,WithHeadings,ShouldAutoSize,WithTitle,WithEvents
{
    use Exportable;
    public function map($fournisseur): array
    {
        return [
            $fournisseur->id,
            $fournisseur->nom,
            $fournisseur->adresse,
            $fournisseur->description,
            $fournisseur->created_at,
        ];
    }
    
    public function headings(): array
    {
        return [
            '#',
            'Nom',
            'Adresse',
            'Description',
            'Créé le',
        ];
    }
    public function title(): string
    {
        return 'Fournisseurs';
    }

    public function query()
    {
        return Fournisseur::query();
    }
    
    public function registerEvents(): array{
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];

            return [
                AfterSheet::class => function(AfterSheet $event) use($styleArray) {
                    $cpt = count(Fournisseur::all()) +1;
                    $cellRange = 'A1:E1'; 
                    $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray);
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);  
                    $event->sheet->getStyle('A2:A'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('B2:B'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('C2:C'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('D2:D'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('E2:E'.$cpt)->applyFromArray($styleArray);  
                },
            ];
    }

}
