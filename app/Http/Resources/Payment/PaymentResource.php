<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray($request)
    {
        $bool = (!is_null($this->op) && !is_null($this->number)) ? ' - ' : ' ';
        return [
            'id' => $this->id,
            'date' => $this->date,
            'type' => $this->type,
            'code' => $this->op .$bool. $this->number,
            'op' => $this->op,
            'number' => $this->number,
            'summary' => 'Pagado en '. $this->type . ' F-' . $this->paymentable->number,
            'path' => [
                'name' => $this->path,
                'url' => $this->path ? $this->getBase64Payment($this->path) : NULL,
            ],
            'amount' => number_format((float)$this->amount, 2, '.', ','),
            'paymentable_id' => $this->paymentable_id,
        ];
    }

    public function getBase64Payment($image)
    {
        $path = url('img/payments') .'/'. $image;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}
