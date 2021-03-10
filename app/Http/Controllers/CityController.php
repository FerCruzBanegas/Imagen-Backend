<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    private $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function listing()
    {
        $cities = $this->city->listCities();
        return $this->respond($cities);
    }

    public function statesByCity()
    {
        $data = [
            'pending' => $this->city->pendingByCity(),
            'approved' => $this->city->approvedByCity(),
            'executed' => $this->city->executedByCity(),
        ];
        return $this->respond($data);
    }

    public function quotesPerMonth()
    {
        $data = $this->city->quotesPerMonth();
        return $this->respond($data);
    }
}
