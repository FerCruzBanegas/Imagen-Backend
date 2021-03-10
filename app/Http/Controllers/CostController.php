<?php

namespace App\Http\Controllers;

use App\Cost;
use Illuminate\Http\Request;
use App\Http\Requests\CostRequest;

class CostController extends ApiController
{
    private $cost;

    public function __construct(Cost $cost)
    {
        $this->cost = $cost;
    }

    public function store(CostRequest $request)
    {
    	try {
	    	$cost = $this->cost->create($request->cost);
	    	if (!empty($request->materials)) {
	            $material = array();
	            foreach ($request->materials as $val) {
	                $material[$val['id']] = ['quantity' => $val['quantity'], 'price' => $val['price'], 'total' => $val['total']];
	            }
	            $cost->materials()->attach($material);
	        }

	        if (!empty($request->workers)) {
	        	$cost->workers()->createMany($request->workers);
	        }
    		$cost->deactivated();
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated();
    }   

    public function update(CostRequest $request, Cost $cost)
    {
    	try {
            $cost->update($request->cost);
            if (!empty($request->materials)) {
	            $material = array();
	            foreach ($request->materials as $val) {
	                $material[$val['id']] = ['quantity' => $val['quantity'], 'price' => $val['price'], 'total' => $val['total']];
	            }
	            $cost->materials()->sync($material);
	        }

	        if (!empty($request->workers)) {
	        	$cost->syncWorkers($request->workers);
	        }
	    } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function active(Cost $cost)
    {
    	try {
            $cost->update(['active' => 1]);
            $cost->deactivated();
	    } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }
}
