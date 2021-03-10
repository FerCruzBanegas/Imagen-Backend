<?php

namespace App\Exports;
use PDF;
use Illuminate\Http\Response;

class PdfExport
{
    private $view;

    private $pdf;

    public function __construct($view, $data)
    {
        $this->pdf = PDF::loadView($view, $data);
        $this->view = $view;
    }

    public function options()
    {
        $this->pdf->setOption('margin-top', 5)->setOption('margin-bottom', 5)->setOption('margin-left', 5)->setOption('margin-right', 5);
        return $this;
    }

    public function letter()
    {
        $this->pdf->setPaper('letter');
        return $this;
    }

    public function portrait()
    {
        $this->pdf->setOrientation('portrait');
        return $this;
    }

    public function landscape()
    {
        $this->pdf->setOrientation('landscape');
        return $this;
    }

    public function download($filename = null)
    {
        return $this->pdf->download();
    }
}