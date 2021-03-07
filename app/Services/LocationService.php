<?php

namespace App\Services;

use App\Models\Location;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

/**
 * Class LocationService.
 */
class LocationService extends BaseService
{
    /**
     * LocationService constructor.
     *
     * @param  Location  $Location
     */
    public function __construct(Location $location)
    {
        $this->model = $location;
    }

    public function searchPaginate($search = null)
    {
        $user = Auth::user();
        if (! $user->can('kiims.view')) {
            throw new GeneralException(__('You do not have access to do that.'));
        }

        $query = $this->model->query();
        if (! empty($search)) {
            $search = '%';
            $query->where('name', 'like', $search);
        }

        return $query->paginate();
    }


    public function datatables($search = '')
    {
        $user = Auth::user();
        if (! $user->can('kiims.view')) {
            throw new GeneralException(__('You do not have access to do that.'));
        }
        $query = $this->model->query();

        if (! empty($search)) {
            $query->whereLike(['name'], $search);
        }

        return $query;
    }

    public function store(array $data = []): Location
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.create')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return  $this->model::create($data);
    }

    /**
     * @param Location $item
     * @param array $data
     * @return bool
     */
    public function update(Location $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->update($data);
    }

    public function delete(Location $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->delete($data);
    }
}
