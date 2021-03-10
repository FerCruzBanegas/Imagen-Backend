<?php

namespace App\Exports\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class NotesExport implements FromCollection
{
	use Exportable;

	private $notes;

	public function __construct($notes)
    {
        $this->notes = $notes;
    }

    public function collection()
    {
        return collect($this->notes);
    }
}
