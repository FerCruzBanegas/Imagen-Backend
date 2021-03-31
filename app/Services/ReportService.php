<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\ReportsExport;

class ReportService
{
    public function __construct()
    {
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set('America/Caracas');
    }

    public function manyPdfDownload(Request $request) 
    {
        $data = [
            'title' => $request->title,
            'office' => auth()->user()->office->description,
            'date' => $request->date,
            'now' => date("d/m/Y"),
            'items' => $request->data,
            'columns' => array_keys($request->data[0])
        ];

        $export = new PdfExport('pdf.report-list', $data);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        return (new ReportsExport($request->data))->download('reporte.xlsx');
    }
}
