<?php

namespace App\Http\Resources\Quotation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Office\OfficeResource;
use App\Http\Resources\WorkOrder\WorkOrderResource;
use App\Http\Resources\Invoice\InvoiceCollection;
use App\Http\Resources\Note\NoteResource;

class QuotationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cite' => $this->cite,
            'state' => $this->state_id,
            'condition' => $this->condition,
            'attends' => $this->attends,
            'attends_phone' => $this->attends_phone,
            'installment' => $this->installment,
            'date' => $this->date,
            'amount' => $this->amount,
            'discount' => $this->discount,
            'term' => $this->term,
            'payment' => $this->payment,
            'validity' => $this->validity,
            'note' => $this->note,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
            'invoice' => new InvoiceCollection($this->invoices),
            'receipt' => new NoteResource($this->receipt),
            'products' => collect($this->products)->transform(function($product){
                return [
                    'id' => $product->id,
                    'item_id' => $product->pivot->id,
                    'uuid' => $product->pivot->uuid,
                    'name' => $product->name,
                    'quantity' => $product->pivot->quantity,
                    'dimension' => $product->pivot->dimension,
                    'description' => $product->pivot->description,
                    'material' => is_null($product->pivot->material) ? $product->material : $product->pivot->material,
                    'quality' => is_null($product->pivot->quality) ? $product->quality : $product->pivot->quality,
                    'finish' => is_null($product->pivot->finish) ? $product->finish : $product->pivot->finish,
                    'materialCheck' => $product->pivot->materialCheck === 1 ? true : false,
                    'qualityCheck' => $product->pivot->qualityCheck === 1 ? true : false,
                    'finishCheck' => $product->pivot->finishCheck === 1 ? true : false,
                    'price' => number_format((float)$product->pivot->price, 2, '.', ''),
                    'subtotal' => number_format((float)$product->pivot->subtotal, 2, '.', ''),
                    'price_type' => $product->pivot->price_type,
                    'type' => $product->pivot->type,
                    'state' => $product->pivot->state,
                    'showImage' => $product->pivot->images->count() > 0 ? true : false,
                    'unit' => $product->pivot->unit === 1 ? true : false,
                    'cooldown' => $product->pivot->cooldown === 1 ? true : false,
                    'images' => collect($product->pivot->images)->transform(function($image){
                        return [
                            'id' => $image->id,
                            'name' => $image->path,
                            'path' => $this->getBase64Quotation($image->path),
                        ];
                    }),
                    'design' => [
                        'id' => $product->pivot->design['id'],
                        'filename' => $product->pivot->design['filename'],
                        'machine' => $product->pivot->design['machine'],
                        'quality' => is_null($product->pivot->design['quality']) ? $product->pivot->quality : $product->pivot->design['quality'],
                        'material' => is_null($product->pivot->design['material']) ? $product->pivot->material : $product->pivot->design['material'],
                        'cutting_dimension' => $product->pivot->design['cutting_dimension'],
                        'print_dimension' => $product->pivot->design['print_dimension'],
                        'finished' => is_null($product->pivot->design['finished']) ? $product->pivot->finish : $product->pivot->design['finished'],
                        'test_print' => $product->pivot->design['test_print'],
                        'quote_approved_date' => $product->pivot->design['quote_approved_date'],
                        'design_approved_date' => $product->pivot->design['design_approved_date'],
                        'reference' => $product->pivot->design['reference'],
                        'path' => [
                            'name' => $product->pivot->design['path'],
                            'url' => $product->pivot->design['path'] ? $this->getBase64Design($product->pivot->design['path']) : NULL,
                        ],
                        'support_path' => [
                            'name' => $product->pivot->design['support_path'],
                            'url' => $product->pivot->design['support_path'] ? $this->getBase64Design($product->pivot->design['support_path']) : NULL,
                        ],
                        'set_image_support' => $product->pivot->design['set_image_support'] === 1 ? true : false,
                        'note' => $product->pivot->design['note'],
                        'product_quotation_id' => $product->pivot->id,
                        'quotation' => $this->id,
                        'created' => $product->pivot->design['created_at'],
                        'updated' => $product->pivot->design['updated_at'],
                    ]
                ];
            })->sortBy('item_id')->values()->all(),
            'work_order' => new WorkOrderResource($this->work_order),
            'customer' => new CustomerResource($this->customer),
            'office' => new OfficeResource($this->office),
            'user' => $this->user->name,
        ];
    }

    public function getBase64Design($image)
    {
        $path = url('img/designs') .'/'. $image;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    public function getBase64Quotation($image)
    {
        $path = url('img/quotations') .'/'. $image;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}
