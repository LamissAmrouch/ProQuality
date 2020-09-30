<?php

namespace App\Exports;

use App\Models\Audit;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class AuditsExport implements FromQuery, WithTitle,WithHeadings,ShouldAutoSize,WithMapping,WithEvents{

    use Exportable;
    private $year;

    public function __construct(int $year){
        $this->year = $year;
    }

    public function map($audit): array{
        return [
            $audit->id,
            $audit->updated_at,
            $audit->titre,
            $audit->procede->designation,
            $audit->procede->atelier->nom,
            $audit->resultats,
            collect($audit->actions()->pluck('designation'))->implode('; '),
            collect($audit->regles()->pluck('titre'))->implode('; '),
            $audit->commentaire,
        ];
    }
    
    public function headings(): array{
        return [
            'Audit n°',
            'Date',
            'Titre',
            'Procédé métier',
            'Atelier',
            'Résultat',
            'Actions Correctives',
            'Règles enfreintes',
            'Observations',
        ];
    }

    public function query(){
        return Audit::where('etat','=','traité')->whereYear('updated_at',$this->year)->orderBy('updated_at','desc');
    }

    public function title(): string{
        return 'Journal des audits '.$this->year;
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
                    $cpt = count(Audit::where('etat','=','traité')->whereYear('updated_at',$this->year)->get()) +1;
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
