<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon;

class TaskCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function($task){
            return [
                "id" => $task->id,
                "description" => $task->description,
                "priority" => $task->priority,
                "completed" => $task->completed === 1 ? true : false,
                "date_init" => Carbon::parse($task->date_init)->toDateTimeLocalString(),
                "date_end" => $task->date_end,
                "work_order_id" => $task->work_order_id,
                "employee_id" => ['id' => $task->employee->id, 'name' => $task->employee->name],
            ];
        });
    }
}
