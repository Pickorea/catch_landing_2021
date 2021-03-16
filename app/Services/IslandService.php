<?php

namespace App\Services;

use App\Models\Island;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

/**
 * Class IslandService.
 */
class IslandService extends BaseService
{
    /**
     * IslandService constructor.
     *
     * @param  Island  $island
     */
    public function __construct(Island $island)
    {
        $this->model = $island;
    }

    public function searchPaginate($search = null)
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.view')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        $query = $this->model->query();
        if (! empty($search)) {
            $query->whereLike(['island_name'], $search);
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
            $query->whereLike(['island_name'], $search);
        }

        return $query;
    }

    public function store(array $data = []): Island
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.create')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return  $this->model::create($data);
    }

    /**
     * @param Island $item
     * @param array $data
     * @return bool
     */
    public function update(Island $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->update($data);
    }

    public function delete(Island $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->delete($data);
    }
}
