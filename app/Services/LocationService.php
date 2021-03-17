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
        if (! $user->can('landing.view')) {
            throw new GeneralException(__('You do not have access to do that.'));
        }

        $query = $this->model->query();
        if (! empty($search)) {
            $query->whereLike(['location_name'], $search);
        }

        return $query->paginate();
    }


    public function datatables($search = '')
    {
        $user = Auth::user();
        if (! $user->can('landing.view')) {
            throw new GeneralException(__('You do not have access to do that.'));
        }
        $query = $this->model->query();

        if (! empty($search)) {
            $query->whereLike(['location_name'], $search);
        }

        return $query;
    }

    public function store(array $data = []): Location
    {
        $user = Auth::user();
        if (! $user->can('landing.create')) {
            throw new GeneralException(__('You do not have access to do that.'));
        }

        return  $this->model::create($data);
    }

    /**
     * @param Location $item
     * @param array $data
     * @return bool
     */
    public function update(Location $item, array $data = []): bool
    {
        $user = Auth::user();
        if (! $user->can('landing.edit')) {
            throw new GeneralException(__('You do not have access to do that.'));
        }

        return $item->update($data);
    }

    public function delete(Location $item, array $data = []): bool
    {
        $user = Auth::user();
        if (! $user->can('landing.edit')) {
            throw new GeneralException(__('You do not have access to do that.'));
        }

        return $item->delete($data);
    }
}
