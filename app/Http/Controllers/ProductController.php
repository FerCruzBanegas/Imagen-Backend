<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Filters\ProductSearch\Searches\ProductsFilter;
use App\Filters\ProductSearch\ProductSearch;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductDetailResource;
use App\Services\ProductService;

class ProductController extends ApiController
{
    private $product;

    private $service;

    public function __construct(Product $product, ProductService $service)
    {
        $this->product = $product;
        $this->service = $service;
    } 

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new ProductCollection(ProductSearch::apply($request, $this->product));
        }

        $products = ProductSearch::checkSortFilter($request, $this->product->newQuery());

        return new ProductCollection($products->paginate($request->take)); 
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = $this->product->create($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product); 
    }

    public function detail(Product $product)
    {
        return new ProductDetailResource($product); 
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->update($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated($product);
    }

    public function destroy(Request $request)
    {
        try {
            $data = [];
            $products = $this->product->find($request->products);
            foreach ($products as $product) {
                $model = $product->secureDelete();
                if ($model) {
                    $data[] = $product->setAppends([]);
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

    public function search(ProductsFilter $filters)
    {
        $products = $this->product->filter($filters)->get();
        return $this->respond($products);
    }
}
