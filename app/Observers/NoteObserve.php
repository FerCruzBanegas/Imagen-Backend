<?php

namespace App\Observers;

use App\Note;

class NoteObserve
{
    public function created(Note $note): void
    {
        $note->quotation->update(['condition' => 2]);
    }

    public function deleted(Note $note): void
    {
        $note->quotation->update(['condition' => 1]);
    }
}
