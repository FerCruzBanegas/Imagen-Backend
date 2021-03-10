<?php

namespace App\Observers;

use App\Invoice;

class InvoiceObserver
{
    public function created(Invoice $invoice): void
    {
        $invoice->quotation->update(['condition' => 0]);
    }
}
