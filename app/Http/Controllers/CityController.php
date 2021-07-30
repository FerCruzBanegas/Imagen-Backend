<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;

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

    public function store(CityRequest $request)
    {
        try {
            $city = $this->city->create($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated($city);
    }
}
