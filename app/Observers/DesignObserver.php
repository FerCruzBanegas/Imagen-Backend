<?php

namespace App\Observers;

use App\Design;
use Carbon\Carbon;

class DesignObserver
{
    public function created(Design $design): void
    {
        $design->quotation->update(['state' => 1]);
    }
}
