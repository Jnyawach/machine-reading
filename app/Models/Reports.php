<?php

namespace App\Models;
///include '..\vendor\autoload.php';

use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportAll;

class Reports
{
    public static function generate($format,$view,$data,$fileName){
        if($format=="excel"){
            $export=new ExportAll($view,$data);
            return Excel::download($export, $fileName.'.xlsx');
        }else{
            //Barry
            $pdf =PDF::loadView($view,$data)->setOption(['defaultFont' => 'sans-serif'])
                            ->setPaper('a4', 'landscape');

            $pdf->setOption('javascript-delay', 30000);
            $pdf->setOption('isHtml5ParserEnabled', true);
            $pdf->setOption('isRemoteEnabled', true);

            return $pdf->download($fileName.'.pdf');
        }
    }
}