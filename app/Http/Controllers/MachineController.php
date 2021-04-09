<?php

namespace App\Http\Controllers;

use App\Machine;
use Illuminate\Http\Request;
use App\Http\Requests\MachineRequest;
use App\Filters\MachineSearch\Searches\MachinesFilter;
use App\Filters\MachineSearch\MachineSearch;
use App\Http\Resources\Machine\MachineCollection;

class MachineController extends ApiController
{
    private $machine;

    public function __construct(Machine $machine)
    {
        $this->machine = $machine;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new MachineCollection(MachineSearch::apply($request, $this->machine));
        }

        $machines = MachineSearch::checkSortFilter($request, $this->machine->newQuery());

        return new MachineCollection($machines->paginate($request->take)); 
    }

    public function store(MachineRequest $request)
    {
        try {
            $machine = $this->machine->create($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated($machine);
    }

    public function update(MachineRequest $request, Machine $machine)
    {
        try {
            $machine->update($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    // public function destroy(Request $request)
    // {
    //     try {
    //         $data = [];
    //         $materials = $this->material->find($request->materials);
    //         foreach ($materials as $material) {
    //             $model = $material->secureDelete();
    //             if ($model) {
    //                 $data[] = $material;
    //             }
    //         }
    //     } catch (Exception $e) {
    //         return $this->respondInternalError();
    //     }
    //     return $this->respondDeleted($data);
    // }

    public function listing()
    {
        $machines = $this->machine->listMachines();
        return $this->respond($machines);
    }

    public function search(MachinesFilter $filters)
    {
        $machines = $this->machine->filter($filters)->get();
        return $this->respond($machines);
    }
}
