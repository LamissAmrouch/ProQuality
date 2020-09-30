<?php

namespace App\Exports;

use App\Models\Anomalie;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class AnomaliesExport implements FromQuery, WithTitle,WithHeadings,ShouldAutoSize,WithMapping,WithEvents{

    use Exportable;
    private $year;

    public function __construct(int $year){
        $this->year = $year;
    }

    public function map($anomalie): array{
        return [
            $anomalie->id,
            $anomalie->updated_at,
            $anomalie->titre,
            $anomalie->type,
            $anomalie->lot->produit->nom,
            $anomalie->lot->caracteristiquep,
            $anomalie->lot->quantite,
            $anomalie->criticite,
            $anomalie->test->nom,
            $anomalie->diagnostique,
            collect($anomalie->actions()->pluck('designation'))->implode('; '),
            collect($anomalie->regles()->pluck('titre'))->implode('; '),
            $anomalie->cause,
        ];
    }
    
    public function headings(): array{
        return [
            'Anomalie n°',
            'Date',
            'Titre',
            'Source',
            'Article',
            'Caracteristique',
            'Qté Retourné',
            'Criticité (%)',
            'Test réalisé',
            'Problème',
            'Actions Correctives',
            'Règles Enfreintes',
            'Cause racine',
        ];
    }

    public function query(){
        return Anomalie::where('etat','=','traité')->whereYear('updated_at',$this->year)->orderBy('updated_at','desc');
    }

    public function title(): string{
        return 'Journal des anomalies '.$this->year;
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
                    $cpt = count(Anomalie::where('etat','=','traité')->whereYear('updated_at',$this->year)->get()) +1;
                    $cellRange = 'A1:M1'; 
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
                    $event->sheet->getStyle('J2:J'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('K2:K'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('L2:L'.$cpt)->applyFromArray($styleArray);
                    $event->sheet->getStyle('M2:M'.$cpt)->applyFromArray($styleArray);
                },
            ];
    }
}
