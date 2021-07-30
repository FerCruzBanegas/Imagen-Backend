<?php

namespace App\Services;

use App\Rental;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\RentalsExport;
use App\Transformers\RentalTransformer;

class RentalService
{
    protected $transformer;

    public function __construct(RentalTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function manyPdfDownload(Request $request) 
    {
        if (empty($request->rental)) {
            $rentals = $this->transformer->collection(Rental::desc()->get());
        } else {
            $rentals = $this->transformer->collection(Rental::in($request->rental)->get());
        }

        $export = new PdfExport('pdf.rental-list', $rentals);
        return $export->options()->letter()->landscape()->download();
    }

    public function pdfListRenovations(Request $request) 
    {
        $rentals = $this->transformer->collection(Rental::in($request->rentals)->orderBy('id', 'desc')->get());

        $export = new PdfExport('pdf.rental-list', $rentals);
        return $export->options()->letter()->landscape()->download();
    }

    public function detailPdfDownload(Request $request) 
    {
        $rentals = $this->transformer->collection(Rental::in($request->rental)->get());

        $export = new PdfExport('pdf.rental-photo', $rentals);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        if (empty($request->rental)) {
            $rentals = $this->transformer->collection(Rental::desc()->get());
        } else {
            $rentals = $this->transformer->collection(Rental::in($request->rental)->get());
        }

        return (new RentalsExport($rentals))->download('rentals.xlsx');
    }

    public function excelListRenovations(Request $request) 
    {
        $rentals = $this->transformer->collection(Rental::in($request->rentals)->orderBy('id', 'desc')->get());

        return (new RentalsExport($rentals))->download('rentals.xlsx');
    }
}
