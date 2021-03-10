<?php

namespace App\Exports\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class QuotationsExport implements FromCollection
{
	use Exportable;

	private $quotations;

	public function __construct($quotations)
    {
        $this->quotations = $quotations;
    }

    public function collection()
    {
        return collect($this->quotations);
    }
}
