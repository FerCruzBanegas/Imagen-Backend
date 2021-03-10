<?php

namespace App\Services;

use App\Payment;
use Illuminate\Http\Request;
use App\Services\ImagePaymentService;
use App\Exports\PdfExport;

class PaymentService extends ImagePaymentService
{
    public function singlePdfDownload(Request $request) 
    {
        $export = new PdfExport('pdf.payment', ['payment' => $request->payment]);
        return $export->options()->letter()->download();
    }
}
