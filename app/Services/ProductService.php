<?php

namespace App\Services;

use App\Product;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\ProductsExport;
use App\Transformers\ProductTransformer;

class ProductService
{
    protected $transformer;

    public function __construct(ProductTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function manyPdfDownload(Request $request) 
    {
        if (empty($request->product)) {
            $products = $this->transformer->collection(Product::desc()->get());
        } else {
            $products = $this->transformer->collection(Product::in($request->product)->get());
        }

        $export = new PdfExport('pdf.product-list', $products);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        if (empty($request->product)) {
            $products = $this->transformer->collection(Product::desc()->get());
        } else {
            $products = $this->transformer->collection(Product::in($request->product)->get());
        }

        return (new ProductsExport($products))->download('products.xlsx');
    }
}
