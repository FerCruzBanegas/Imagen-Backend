<?php

namespace App\Services;

use App\Design;
use Illuminate\Http\Request;
use App\Services\ImageDesignService;
use App\Exports\PdfExport;
use App\Transformers\DesignTransformer;

class DesignService extends ImageDesignService
{
    protected $transformer;

    public function __construct(DesignTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function singlePdfDownload(Request $request) 
    {
        $design = $this->transformer->item(Design::find($request->design));

        $export = new PdfExport('pdf.design', $design);
        return $export->options()->letter()->download();
    }
}
