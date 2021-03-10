<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use App\Http\Requests\MaterialRequest;
use App\Filters\MaterialSearch\Searches\MaterialsFilter;
use App\Filters\MaterialSearch\MaterialSearch;
use App\Http\Resources\Material\MaterialCollection;

class MaterialController extends ApiController
{
    private $material;

    public function __construct(Material $material)
    {
        $this->material = $material;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new MaterialCollection(MaterialSearch::apply($request, $this->material));
        }

        $materials = MaterialSearch::checkSortFilter($request, $this->material->newQuery());

        return new MaterialCollection($materials->paginate($request->take)); 
    }

    public function store(MaterialRequest $request)
    {
        try {
            $material = $this->material->create($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated($material);
    }

    public function update(MaterialRequest $request, Material $material)
    {
        try {
            $material->update($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function destroy(Request $request)
    {
        try {
            $data = [];
            $materials = $this->material->find($request->materials);
            foreach ($materials as $material) {
                $model = $material->secureDelete();
                if ($model) {
                    $data[] = $material;
                }
            }
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondDeleted($data);
    }

    public function search(MaterialsFilter $filters)
    {
        $materials = $this->material->filter($filters)->get();
        return $this->respond($materials);
    }
}
