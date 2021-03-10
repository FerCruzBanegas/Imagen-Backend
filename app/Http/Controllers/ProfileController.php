<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Filters\ProfileSearch\ProfileSearch;
use App\Http\Resources\Profile\ProfileCollection;
use App\Http\Resources\Profile\ProfileResource;
use Illuminate\Support\Facades\DB;

class ProfileController extends ApiController
{
	private $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    } 

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new ProfileCollection(ProfileSearch::apply($request, $this->profile));
        }

        $profiles = ProfileSearch::checkSortFilter($request, $this->profile->newQuery());

        return new ProfileCollection($profiles->paginate($request->take)); 
    }

    public function show(Profile $profile)
    {
        return new ProfileResource($profile); 
    }

    public function store(ProfileRequest $request)
    {
        DB::beginTransaction();
        try {
            $profile = $this->profile->create($request->all());
            $this->syncActions($profile, $request->input('action_list'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respondCreated();
    }

    public function update(ProfileRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $profile = $this->profile->find($id);
            $profile->update($request->all());
            $this->syncActions($profile, $request->input('action_list'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function destroy(Request $request)
    {
        try {
            $data = [];
            $profiles = $this->profile->find($request->profiles);
            foreach ($profiles as $profile) {
                $model = $profile->secureDelete();
                if ($model) {
                    $data[] = $profile->setAppends([]);
                }
            }
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondDeleted($data);
    }

    public function listing()
    {
        $profiles = $this->profile->listProfiles();
        return $this->respond($profiles);
    }

    private function syncActions(Profile $profile, array $actions)
    {
        $profile->actions()->sync($actions);
    }
}
