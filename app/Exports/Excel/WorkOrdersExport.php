<?php

namespace App\Exports\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class WorkOrdersExport implements FromCollection
{
	use Exportable;

	private $workOrders;

	public function __construct($workOrders)
    {
        $this->workOrders = $workOrders;
    }

    public function collection()
    {
        return collect($this->workOrders);
    }
}
