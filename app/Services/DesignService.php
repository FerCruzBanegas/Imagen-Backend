<?php

namespace App\Services;

use App\Design;
use Illuminate\Http\Request;
use App\Services\ImageDesignService;
use App\Exports\PdfExport;

class DesignService extends ImageDesignService
{
    public function singlePdfDownload(Request $request) 
    {
        $export = new PdfExport('pdf.design', ['design' => $request->design]);
        return $export->options()->letter()->download();
    }
}
