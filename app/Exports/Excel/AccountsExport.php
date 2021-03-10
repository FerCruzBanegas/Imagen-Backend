<?php

namespace App\Exports\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class AccountsExport implements FromCollection
{
	use Exportable;

	private $accounts;

	public function __construct($accounts)
    {
        $this->accounts = $accounts;
    }

    public function collection()
    {
        return collect($this->accounts);
    }
}
