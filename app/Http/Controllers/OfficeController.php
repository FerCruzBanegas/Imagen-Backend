<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;

class OfficeController extends ApiController
{
    private $office;

    public function __construct(Office $office)
    {
        $this->office = $office;
    }

    public function listing()
    {
        $offices = $this->office->listOffices();
        return $this->respond($offices);
    }
}
