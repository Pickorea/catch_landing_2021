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

        $query = $this->model->query()
            ->leftjoin('fishermans', 'fishermans.id', '=', 'trips.fisherman_id')
            ->leftjoin('methods', 'methods.id', '=', 'trips.method_id')
            ->leftjoin('locations', 'locations.id', '=', 'trips.location_id')
            ->leftjoin('islands', 'islands.id', '=', 'fishermans.island_id')
            ->select([
                'trips.trip_hrs', 'trips.number_of_fishers', 'trips.trip_date', 'trips.id','fishermans.first_name', 'fishermans.last_name','locations.location_name','methods.method_name','islands.island_name'
            ]);

        if (! empty($search)) {
            $query->whereLike(['first_name','last_name'], $search);
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
