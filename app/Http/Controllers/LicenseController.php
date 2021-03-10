<?php

namespace App\Http\Controllers;

use App\License;
use Illuminate\Http\Request;
use App\Http\Resources\License\LicenseResource;

class LicenseController extends ApiController
{
	private $license;

    public function __construct(License $license)
    {
        $this->license = $license;
    }

    public function getLicense(Request $request)
    {
    	$dosage = $this->license->dosage($request->office);
    	return new LicenseResource($dosage);
    }
}
