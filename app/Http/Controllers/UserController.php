<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Filters\UserSearch\UserSearch;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;

class UserController extends ApiController
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new UserCollection(UserSearch::apply($request, $this->user));
        }

        $users = UserSearch::checkSortFilter($request, $this->user->newQuery());

        return new UserCollection($users->paginate($request->take)); 
    }

    public function show(User $user)
    {
        return new UserResource($user); 
    }

    public function store(UserRequest $request)
    {
        try {
            $this->user->create($request->all());
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated();
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            if ($request->filled('state')) {
                $user->update($request->all());
            } else {
                $user->name = $request->name;
                $user->forename = $request->forename;
                $user->surname = $request->surname;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->save();
            }
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated($request->all());
    }

    public function password(UserPasswordRequest $request, User $user)
    {
        try {
            $user->update(['password' => $request->password]);
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function changeState(User $user) 
    {
        try {
            if ($user->state) {
                $user->update(['state' => 0]);
            } else {
                $user->update(['state' => 1]);
            }
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function destroy(Request $request)
    {
        try {
            $data = [];
            $users = $this->user->find($request->users);
            foreach ($users as $user) {
                $model = $user->secureDelete();
                if ($model) {
                    $data[] = $user;
                }
            }
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondDeleted($data);
    }

    public function listing()
    {
        $users = $this->user->listUsers();
        return $this->respond($users);
    }

    public function listSeller()
    {
        $users = $this->user->listSeller();
        return $this->respond($users);
    }
}
