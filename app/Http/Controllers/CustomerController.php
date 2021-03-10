<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Filters\CustomerSearch\Searches\CustomersFilter;
use App\Filters\CustomerSearch\CustomerSearch;
use App\Http\Resources\Customer\CustomerCollection;
use App\Http\Resources\Customer\CustomerQuotesCollection;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Customer\CustomerDetailResource;
use App\Services\CustomerService;

class CustomerController extends ApiController
{
    private $customer;

    private $service;

    public function __construct(Customer $customer, CustomerService $service)
    {
        $this->customer = $customer;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new CustomerCollection(CustomerSearch::apply($request, $this->customer));
        }

        $customers = CustomerSearch::checkSortFilter($request, $this->customer->newQuery());

        return new CustomerCollection($customers->paginate($request->take)); 
    }

    public function store(CustomerRequest $request)
    {
        try {
            $customer = $this->customer->create($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated($customer->load('city'));
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer); 
    }

    public function detail(Customer $customer)
    {
        return new CustomerDetailResource($customer); 
    }

    public function getCustomerQuotes(Request $request)
    {
        $customer = $this->customer->find($request->id)->quotations()->paginate($request->per_page);
        return new CustomerQuotesCollection($customer); 
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $customer->update($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function destroy(Request $request)
    {
        try {
            $data = [];
            $customers = $this->customer->find($request->customers);
            foreach ($customers as $customer) {
                $model = $customer->secureDelete();
                if ($model) {
                    $data[] = $customer;
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
        $customers = $this->customer->listCustomers();
        return $this->respond($customers);
    }

    public function search(CustomersFilter $filters)
    {
        $customers = $this->customer->filter($filters)->with('city')->get();
        return new CustomerCollection($customers);
    }
}
