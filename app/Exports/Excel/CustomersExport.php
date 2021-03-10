<?php

namespace App\Exports\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class CustomersExport implements FromCollection
{
	use Exportable;

	private $customers;

	public function __construct($customers)
    {
        $this->customers = $customers;
    }

    public function collection()
    {
        return collect($this->customers);
    }
}
