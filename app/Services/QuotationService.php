<?php

namespace App\Services;

use App\Quotation;
use App\ImagesProduct;
use App\Design;
use Illuminate\Http\Request;
use App\Services\ImageQuotationService;
use App\Services\ImageDesignService;
use App\Exports\PdfExport;
use App\Exports\Excel\QuotationsExport;
use App\Transformers\QuotationTransformer;

class QuotationService
{
    protected $service;

    protected $transformer;

    public function __construct(ImageQuotationService $service, QuotationTransformer $transformer)
    {
        $this->service = $service;
        $this->transformer = $transformer;
    }

    public function singlePdfDownload(Quotation $quotation) 
    {
        $export = new PdfExport('pdf.quotation', ['quotation' => $quotation]);
        return $export->options()->letter()->download();
    }

    public function manyPdfDownload(Request $request) 
    {
        if (empty($request->quotation)) {
            $quotations = $this->transformer->collection(Quotation::desc()->checklist()->get());
        } else {
            $quotations = $this->transformer->collection(Quotation::in($request->quotation)->checklist()->get());
        }

        $export = new PdfExport('pdf.quotation-list', $quotations);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        if (empty($request->quotation)) {
            $quotations = $this->transformer->collection(Quotation::desc()->checklist()->get());
        } else {
            $quotations = $this->transformer->collection(Quotation::in($request->quotation)->checklist()->get());
        }

        return (new QuotationsExport($quotations))->download('quotations.xlsx');
    }

    private function collectionsAreEqual($collection1, $collection2)
    {
        if ($collection1->count() != $collection2->count()) {
            return false;
        }
        
        $collection2 = $collection2->keyBy('uuid');
        foreach ($collection1->keyBy('uuid') as $uuid => $item) {
            if (!isset($collection2[$uuid])) {
                return false;
            }

            if ($collection2[$uuid] != $item) {
                return false;
            }
        }
        return true;
    }

    public function checkDataChange(Quotation $quotation, Request $request)
    {
        $collection1 = collect($request->products)->transform(function($product){
            return [
                'id' => $product['id'],
                'uuid' => $product['uuid'],
                'quantity' => $product['quantity'],
                'dimension' => $product['dimension'],
                'description' => $product['description'],
                //cambio aqui
                'material' => isset($product['material']) ? $product['material'] : null,
                'quality' => isset($product['quality']) ? $product['quality'] : null,
                'finish' => isset($product['finish']) ? $product['finish'] : null,
                'materialCheck' => $product['materialCheck'],
                'qualityCheck' => $product['qualityCheck'],
                'finishCheck' => $product['finishCheck'],
                //hasta aqui
                'price' => $product['price'],
                'subtotal' => $product['subtotal'],
                'images' => collect($product['images'])->transform(function($image){
                    return [
                        'name' => $image['name'],
                    ];
                }),
            ];
        });

        $collection2 = collect($quotation->products)->transform(function($product){
            return [
                'id' => $product->id,
                'uuid' => $product->pivot->uuid,
                'quantity' => $product->pivot->quantity,
                'dimension' => $product->pivot->dimension,
                'description' => $product->pivot->description,
                //cambio aqui
                'material' => $product->pivot->material,
                'quality' => $product->pivot->quality,
                'finish' => $product->pivot->finish,
                'materialCheck' => $product->pivot->materialCheck === 1 ? true : false,
                'qualityCheck' => $product->pivot->qualityCheck === 1 ? true : false,
                'finishCheck' => $product->pivot->finishCheck === 1 ? true : false,
                //hasta aqui
                'price' => number_format((float)$product->pivot->price, 2, '.', ','),
                'subtotal' => $product->pivot->subtotal,
                'images' => collect($product->pivot->images)->transform(function($image){
                    return [
                        'name' => $image->path,
                    ];
                })
            ];
        });  

        return $this->collectionsAreEqual($collection1, $collection2); 
    }

    private function getProductQuotation(Quotation $quotation, Request $request)
    {
        $pivots = $quotation->products->map(function ($item) {
            return $item->pivot;
        });

        $productQuotation = collect([]);
        foreach ($request->products as $product) {
            foreach ($pivots as $pivot) {
                if ($product['uuid'] == $pivot['uuid']) {
                    $pivot['files'] = $product['images']; 
                    $productQuotation[] = $pivot;
                }
            }
        }
        return $productQuotation;
    }

    public function deleteImagesProduct()
    {
        $ip = ImagesProduct::whereNull('product_quotation_id')->get();
        
        if ($ip->count()) {
            $ip->each(function ($item) {
                if ($this->service->deleteFile($item->path)) { 
                    $item->delete();
                }
            });
        }
    }

    public function syncImagesQuotation(Quotation $quotation, Request $request) 
    {
        $productQuotation = $this->getProductQuotation($quotation, $request);

        $productQuotation->each(function ($item) {
            $files_request = collect($item->files);

            //ver xq no entra pa guardar las foto
            $attachments = $files_request->map(function ($val) {
                $image_name = $this->service->getNameFile($val['path']);
                $this->service->saveFile($val['path'], $image_name);
                $val['path'] = $image_name;
                return $val;
            })->toArray();
            
            $item->images()->createMany($attachments);
        });

        $this->deleteImagesProduct();

        $id = Design::whereNull('product_quotation_id')->get();
        $design_service = new ImageDesignService();
        
        if ($id->count()) {
            $id->each(function ($item) use ($design_service) {
                if ($design_service->deleteFile($item->path)) { 
                    $item->delete();
                }
            });
        }
    }
}
