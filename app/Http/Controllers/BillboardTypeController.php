<?php

namespace App\Http\Controllers;

use App\BillboardType;
use Illuminate\Http\Request;

class BillboardTypeController extends ApiController
{
    private $billboardType;

    public function __construct(BillboardType $billboardType)
    {
        $this->billboardType = $billboardType;
    }

    public function listing()
    {
        $billboardTypes = $this->billboardType->listBillboardTypes();
        return $this->respond($billboardTypes);
    }
}
