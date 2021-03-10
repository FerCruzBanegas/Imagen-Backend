<?php

namespace App\Http\Controllers;

use App\Task;
use App\WorkOrder;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\task\taskCollection;

class TaskController extends ApiController
{
    private $task;

    public function __construct(Task $task)
    {
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set('America/Caracas');

        $this->task = $task;
    }

    public function store(TaskRequest $request)
    {
    	try {
            $workOrder = WorkOrder::find($request->work_order);
            if(is_null($workOrder->closing_date)) 
            {
                $workOrder->tasks()->sync($request->tasks);
            } else {
                return $this->respond(message('MSG015'), 406);
            }
            
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated(new taskCollection($workOrder->tasks));
    }  
    
    public function closeTasks(Request $request)
    {
    	try {
            $tasks = $this->task->whereIn('id', $request->tasks);
            $tasks->update(['completed' => true, 'date_end' => date('Y-m-d H:i:s')]);
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated(new taskCollection($tasks->get()));
    }  
}