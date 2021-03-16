<?php

namespace App\Services;

use App\Models\Fisherman;
use App\Models\Trip;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

/**
 * Class FishermanService.
 */
class FishermanService extends BaseService
{
    /**
     * FishermanService constructor.
     *
     * @param  Fisherman $fisherman
     */
    public function __construct(Fisherman $fisherman)
    {
        $this->model = $fisherman;
    }

    public function searchPaginate($search = null)
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.view')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        $query = $this->model->query();
        if (! empty($search)) {
            $query->whereLike(['first_name','last_name', 'island_name'], $search);
        }

        return $query->paginate();
    }

    public function datatables($search = '', int $island_id = 0)
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.view')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        $query = $this->model->query()
            ->leftJoin('islands', 'islands.id', '=', 'island_id')
            ->select(['fishermans.id', 'first_name', 'last_name', 'island_name as island']);

        if (! empty($search)) {
            $query->whereLike(['first_name','last_name', 'island_name'], $search);
        }

        if ($island_id > 0) {
            $query->where('island_id', '=', $island_id);
        }

        return $query;
    }


    /**
     * @param array $data
     * @return Trip
     * @throws GeneralException
     */
    public function store(array $data = []): Trip
    {
//        DB::beginTransaction();
        // $user = Auth::user();
        // if (! $user->can('kiims.create')) {
        //     throw new GeneralException(__('Not Authorised'));
        // }

        $item = $this->model::create($data);

//        $species_pivot = [];
//        for ($i=0; $i < count($species); $i++) {
//            if ($species[$i] != '') {
//                $species_pivot[$species[$i]] = ['weight' => $weight[$i]];
//            }
//        }
//        $item->species()->sync($species_pivot);


        return   $item;

//        DB::rollBack();
    }


    /**
     * @param Trip $item
     * @param array $data
     * @return Crime
     */
    public function update(Trip $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->update($data);
    }

    public function delete(Trip $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->delete();
    }
}
