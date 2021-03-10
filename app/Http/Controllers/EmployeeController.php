<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Filters\EmployeeSearch\EmployeeSearch;
use App\Filters\EmployeeSearch\Searches\EmployeesFilter;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeSearchCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Services\EmployeeService;

class EmployeeController extends ApiController
{
	private $employee;

    private $service;

    public function __construct(Employee $employee, EmployeeService $service)
    {
        $this->employee = $employee;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new EmployeeCollection(EmployeeSearch::apply($request, $this->employee));
        }

        $employees = EmployeeSearch::checkSortFilter($request, $this->employee->newQuery());

        return new EmployeeCollection($employees->paginate($request->take)); 
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $employee = $this->employee->create($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated($employee);
    }

    public function show(Employee $employee)
    {
        return new EmployeeResource($employee); 
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            $employee->update($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function destroy(Request $request)
    {
        try {
            $data = [];
            $employees = $this->employee->find($request->employees);
            foreach ($employees as $employee) {
                $model = $employee->secureDelete();
                if ($model) {
                    $data[] = $employee;
                }
            }
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondDeleted($data);
    }

    public function listPdf(Request $request)
    {
        return $this->service->manyPdfDownload($request);
    }
    
    public function listExcel(Request $request) 
    {
        return $this->service->manyExcelDownload($request);
    }

    public function listing()
    {
        $employees = $this->employee->listEmployees();
        return $this->respond($employees);
    }

    public function search(EmployeesFilter $filters)
    {
        $employees = $this->employee->filter($filters)->get();
        return new EmployeeSearchCollection($employees);
    }
}
