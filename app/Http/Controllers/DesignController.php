<?php

namespace App\Http\Controllers;

use App\Design;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\DesignRequest;
use App\Services\DesignService;

class DesignController extends ApiController
{
    private $design;
    protected $service;

    public function __construct(Design $design, DesignService $service)
    {
        $this->design = $design;
        $this->service = $service;
    }

    public function store(DesignRequest $request)
    {
        DB::beginTransaction();
        
        try {
            $image_name_support = NULL;
            if($request->design['support_path']['url']) {
                $image_support = $request->design['support_path']['url'];
                $image_name_support = $this->service->getNameFile($image_support);
                $saved_support = $this->service->saveFile($image_support, $image_name_support);
            }

            $image = $request->design['path']['url'];
            $image_name = $this->service->getNameFile($image);

            $saved = $this->service->saveFile($image, $image_name);

            if ($saved) {
                $design = $this->design->create([
                    'filename' => $request->design['filename'], 
                    // 'machine' => $request->design['machine'], 
                    'quality' => $request->design['quality'], 
                    'material' => $request->design['material'], 
                    'cutting_dimension' => $request->design['cutting_dimension'], 
                    'print_dimension' => $request->design['print_dimension'], 
                    'finished' => $request->design['finished'], 
                    'test_print' => $request->design['test_print'], 
                    'quote_approved_date' => $request->design['quote_approved_date'],
                    'design_approved_date' => Carbon::now()->format('Y-m-d'), 
                    'reference' => $request->design['reference'],
                    'note' => $request->design['note'],
                    'path' => $image_name, 
                    'support_path' => $image_name_support, 
                    'set_image_support' => $request->design['set_image_support'], 
                    'product_quotation_id' => $request->design['product_quotation_id'], 
                ]);

                $design->machines()->attach($request->design['machines']);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->service->deleteFile($image_name);
            return $this->respondInternalError();
        }
        return $this->respondCreated($design);
    }

    public function update(DesignRequest $request, $id)
    {
        DB::beginTransaction();
        
        try {
            $design = $this->design->find($id);
            $design->update([
                'filename' => $request->design['filename'], 
                // 'machine' => $request->design['machine'], 
                'quality' => $request->design['quality'], 
                'material' => $request->design['material'], 
                'cutting_dimension' => $request->design['cutting_dimension'], 
                'print_dimension' => $request->design['print_dimension'], 
                'finished' => $request->design['finished'], 
                'test_print' => $request->design['test_print'], 
                'quote_approved_date' => $request->design['quote_approved_date'], 
                'reference' => $request->design['reference'], 
                'note' => $request->design['note'], 
                'set_image_support' => $request->design['set_image_support'],
            ]);

            $design->machines()->sync($request->design['machines']);

            if (!$this->service->checkExistsFile($request->design['path']['name'])) {
                if ($this->service->deleteFile($design->path)) {
                    $image = $request->design['path']['url'];
                    $image_name = $this->service->getNameFile($image);
                    if ($this->service->saveFile($image, $image_name)) {
                        $design->fill(['path' => $image_name])->save();
                    }
                }
            }

            if (!is_null($request->design['support_path']['url'])) {
                if(is_null($design->support_path)) {
                    $image_support = $request->design['support_path']['url'];
                    $image_name_support = $this->service->getNameFile($image_support);
                    if ($this->service->saveFile($image_support, $image_name_support)) {
                        $design->fill(['support_path' => $image_name_support])->save();
                    }
                } else {
                    if (!$this->service->checkExistsFile($request->design['support_path']['name'])) {
                        if ($this->service->deleteFile($design->support_path)) {
                            $image_support = $request->design['support_path']['url'];
                            $image_name_support = $this->service->getNameFile($image_support);
                            if ($this->service->saveFile($image_support, $image_name_support)) {
                                $design->fill(['support_path' => $image_name_support])->save();
                            }
                        }
                    }
                }
            } elseif (is_null($request->design['support_path']['url']) && !is_null($design->support_path)) {
                if ($this->service->deleteFile($design->support_path)) {
                    $design->fill(['support_path' => NULL])->save(); 
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respondUpdated($design);
    }

    public function designPdf(Request $request)
    {
        return $this->service->singlePdfDownload($request);
    }
}
