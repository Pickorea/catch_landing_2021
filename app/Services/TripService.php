<?php

namespace App\Services;

use App\Models\Trip;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

/**
 * Class TripService.
 */
class TripService extends BaseService
{
    /**
     * TripService constructor.
     *
     * @param  Trip  $Trip
     */
    public function __construct(Trip $trip)
    {
        $this->model = $trip;
    }

    public function searchPaginate($search = null)
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.view')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        $query = $this->model->query();
        if (! empty($search)) {
            $search = '%'.$search.'%';
            $query->where('name', 'like', $search)
                ->orWhere('scientific_name', 'like', $search);
        }

        return $query->paginate();
    }

    public function datatables($search = '')
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.view')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        $query = $this->model->query();

        if (! empty($search)) {
            $query->whereLike(['name','scientific_name'], $search);
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
        DB::beginTransaction();
        // $user = Auth::user();
        // if (! $user->can('kiims.create')) {
        //     throw new GeneralException(__('Not Authorised'));
        // }

        $item = $this->model::create($data);

        $species_pivot = [];
        for ($i=0; $i < count($species); $i++) {
            if ($species[$i] != '') {
                $species_pivot[$species[$i]] = ['weight' => $weight[$i]];
            }
        }
        $item->species()->sync($species_pivot);


        return   $item;
        
        DB::rollBack();
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

        return $item->delete($data);
    }
}
