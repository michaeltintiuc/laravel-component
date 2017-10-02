<?php
namespace App\Components\Stubs\Admin;

use DB;
use App\Components\Stubs\Stub;
use MichaelT\Component\Admin\ComponentRepo;
use App\Components\Stubs\Admin\StubsRepoContract;

class StubsRepo extends ComponentRepo implements StubsRepoContract
{
    /**
     * Initialize StubsRepo
     *
     * @param \App\Components\Stubs\Stub $model
     * @return void
     */
    public function __construct(Stub $model)
    {
        parent::__construct($model);
        $this->setComponent('stub');
    }

    /**
     * Get all stubs
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->getModel()->get();
    }

    /**
     * Get paginated stubs
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate()
    {
        return $this->getModel()->paginate($this->getPerPage());
    }

    /**
     * Find a stub by ID
     *
     * @param  int $id
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \FindAdminException
     */
    public function find($id)
    {
        try {
            return $this->getModel()->findOrFail($id);
        } catch (\Exception $e) {
            throw new \FindAdminException($this->error('find'));
        }
    }

    /**
     * Search all stubs by query
     *
     * @param  string $query
     * @return \Illuminate\Support\Collection
     */
    public function search($query)
    {
        return $this->getModel()->where('name', 'like', "%$query%")->get();
    }

    /**
     * Save new stub
     *
     * @param  array $input
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \StoreAdminException
     */
    public function store(array $input)
    {
        DB::beginTransaction();

        try {
            $stub = $this->getModel()->create($input);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \StoreAdminException($this->error('store'));
        }

        DB::commit();
        return $stub;
    }

    /**
     * Update stub by ID
     *
     * @param  int $id
     * @param  array $input
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \UpdateAdminException
     */
    public function update($id, array $input)
    {
        try {
            $stub = $this->getModel()->findOrFail($id);
            $stub->update($input);
        } catch (\Exception $e) {
            throw new \UpdateAdminException($this->error('update'));
        }

        return $stub;
    }

    /**
     * Delete stubs
     *
     * @param  array $ids
     * @return int
     * @throws \DestroyAdminException
     */
    public function destroy(array $ids)
    {
        if (!count($ids)) {
            return 0;
        }

        $key = array_search(\Auth::stub()->id, $ids);

        if ($key !== false) {
            unset($ids[$key]);
        }

        try {
            return $this->getModel()->destroy($ids);
        } catch (\Exception $e) {
            throw new \DestroyAdminException($this->error('destroy'));
        }
    }
}
