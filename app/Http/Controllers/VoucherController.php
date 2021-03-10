<?php

namespace App\Http\Controllers;

use App\Voucher;
use Illuminate\Http\Request;
use App\Http\Resources\Voucher\VoucherResource;

class VoucherController extends ApiController
{
	private $voucher;

    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function getVoucher(Request $request)
    {
    	$number = $this->voucher->number($request->office);
    	return new VoucherResource($number);
    }
}
