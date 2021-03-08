<?php

namespace App\Services;

use App\Models\Species;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

/**
 * Class SpeciesService.
 */
class SpeciesService extends BaseService
{
    /**
     * SpeciesService constructor.
     *
     * @param  Species  $species
     */
    public function __construct(Species $species)
    {
        $this->model = $species;
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
            $query->whereLike(['species_name','scientific_name'], $search);
        }

        return $query;
    }


    /**
     * @param array $data
     * @return Species
     * @throws GeneralException
     */
    public function store(array $data = []): Species
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.create')) {
        //     throw new GeneralException(__('Not Authorised'));
        // }

        return  $this->model::create($data);
    }


    /**
     * @param Species $item
     * @param array $data
     * @return Crime
     */
    public function update(Species $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->update($data);
    }

    public function delete(Species $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->delete($data);
    }
}
