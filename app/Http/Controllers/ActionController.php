<?php

namespace App\Http\Controllers;

use App\Action;
use Illuminate\Http\Request;

class ActionController extends ApiController
{
    protected $action;

    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    public function listing()
    {
        $actions = $this->action->listActions();
        $grouped = $actions->groupBy('title')->values()->transform(function ($item) {
            return [
                'title' => $item->first()->only(['title']),
                'permissions' => $item->transform(function ($t) {
                    return [
                        'id' => $t->id, 
                        'name' => $t->name
                    ];
                }),
                'flag' => false
            ];
        });
        return $this->respond($grouped);
    }
}