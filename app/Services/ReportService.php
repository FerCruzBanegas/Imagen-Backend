<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\ReportsExport;

class ReportService
{
    private $views = [1 => 'pdf.report-list', 2 => 'pdf.report-customer-accounts'];
    

    public function __construct()
    {
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set('America/Caracas');
    }

    public function manyPdfDownload(Request $request) 
    {
        $data = [];

        foreach ($request->data as $key => $value) {
            $data[$key] = $value;
        }

        $data['now'] = date("d/m/Y");

        $export = new PdfExport($this->views[$request->data['type']], $data);
        return $export->{$export->types[$request->data['type']]}();
    }

    public function manyExcelDownload(Request $request) 
    {
        return (new ReportsExport($request->data))->download('reporte.xlsx');
    }
}
