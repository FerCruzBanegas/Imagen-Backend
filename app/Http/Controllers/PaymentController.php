<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Invoice;
use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;
use App\Http\Resources\Payment\PaymentResource;

class PaymentController extends ApiController
{
    private $payment;
    protected $service;
    protected $types = [
        'FACTURA' => Invoice::class,
        'N.REMISION' => Note::class,
    ];

    public function __construct(Payment $payment, PaymentService $service)
    {
        $this->payment = $payment;
        $this->service = $service;
    }

    public function store(PaymentRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $this->types[$request->model]::find($request->type_id);
            $balance = round((float)$model->total - (float)$model->payments->sum('amount'), 2);
            if ($request->amount > $balance) {
                return $this->respond([
                    'message' => 'El monto introducido no puede ser mayor al saldo: '.number_format($balance, 2, '.', ',')
                ], 422);
            }
            $image = $request->path['url'];
            $image_name = $this->service->getNameFile($image);

            $saved = $this->service->saveFile($image, $image_name);

            if ($saved) {
                $payment = $model->payments()->create([
                    'date' => $request->date, 
                    'type' => $request->type, 
                    'path' => $image_name, 
                    'amount' => $request->amount, 
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respondCreated(new PaymentResource($payment));
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        DB::beginTransaction();
        try {
            $payment->update([
                'date' => $request->date, 
                'type' => $request->type, 
                'amount' => $request->amount, 
            ]);

            if (!$this->service->checkExistsFile($request->path['name'])) {
                if ($this->service->deleteFile($payment->path)) {
                    $image = $request->path['url'];
                    $image_name = $this->service->getNameFile($image);
                    if ($this->service->saveFile($image, $image_name)) {
                        $payment->fill(['path' => $image_name])->save();
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respondUpdated(new PaymentResource($payment));
    }

    public function destroy(Payment $payment)
    {
        DB::beginTransaction();
        try {
            if ($this->service->deleteFile($payment->path)) {
                $payment->delete();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respondDeleted();
    }
}
