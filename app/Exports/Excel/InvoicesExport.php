<?php

namespace App\Exports\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class InvoicesExport implements FromCollection
{
	use Exportable;

	private $invoices;

	public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }

    public function collection()
    {
        return collect($this->invoices);
    }
}
