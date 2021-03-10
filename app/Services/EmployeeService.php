<?php

namespace App\Services;

use App\Employee;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\EmployeesExport;
use App\Transformers\EmployeeTransformer;

class EmployeeService
{
    protected $transformer;

    public function __construct(EmployeeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function manyPdfDownload(Request $request) 
    {
        if (empty($request->employee)) {
            $employees = $this->transformer->collection(Employee::desc()->get());
        } else {
            $employees = $this->transformer->collection(Employee::in($request->employee)->get());
        }

        $export = new PdfExport('pdf.employee-list', $employees);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        if (empty($request->employee)) {
            $employees = $this->transformer->collection(Employee::desc()->get());
        } else {
            $employees = $this->transformer->collection(Employee::in($request->employee)->get());
        }

        return (new EmployeesExport($employees))->download('employees.xlsx');
    }
}
