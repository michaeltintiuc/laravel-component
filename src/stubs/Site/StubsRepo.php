<?php
namespace App\Components\Stubs\Site;

use App\Components\Stubs\Stub;
use MichaelT\Component\Site\ComponentRepo;
use App\Components\Stubs\Site\StubsRepoContract;

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
     * @throws \FindSiteException
     */
    public function find($id)
    {
        try {
            return $this->getModel()->findOrFail($id);
        } catch (\Exception $e) {
            throw new \FindSiteException($this->error('find'));
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
}
