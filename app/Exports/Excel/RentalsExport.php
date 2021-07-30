<?php

namespace App\Exports\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class RentalsExport implements FromCollection
{
	use Exportable;

	private $rentals;

	public function __construct($rentals)
    {
        $this->rentals = $rentals;
    }

    public function collection()
    {
        return collect($this->rentals);
    }
}
