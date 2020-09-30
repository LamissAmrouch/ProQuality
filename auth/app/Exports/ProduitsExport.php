<?php

namespace App\Exports;

use App\Models\Produit;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProduitsExport implements FromQuery,WithMapping,WithHeadings,ShouldAutoSize,WithTitle,WithEvents
{
    use Exportable;
    public function map($article): array
    {
        return [
            $article->id,
            $article->nom,
            $article->type,
            $article->modele,
            $article->description,
            $article->prix,
            collect($article->procedes()->pluck('designation'))->implode('; '),
            collect($article->caracteristiques()->pluck('nom'))->implode('; '),
            $article->created_at,
        ];
    }
    
    public function headings(): array
    {
        return [
            '#',
            'Nom',
            'Type',
            'Modèle',
            'Description',
            'Prix',
            'Procedes',
            'Caractéristique',
            'Crée le',
        ];
    }
    public function title(): string
    {
        return 'Articles';
    }

    public function query()
    {
        return Produit::query();
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
                    $cpt = count(Produit::all()) +1;
                    $cellRange = 'A1:I1'; 
                    $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray);
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);  
                    $event->sheet->getStyle('A2:A'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('B2:B'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('C2:C'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('D2:D'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('E2:E'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('F2:F'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('G2:G'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('H2:H'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('I2:I'.$cpt)->applyFromArray($styleArray);
                    
                },
            ];
    }
}
