<?php
namespace MichaelT\Component\Admin\Contracts;

interface RepoContract
{
    /**
     * Get all results
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get paginated results
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate();

    /**
     * Find a Model by ID
     *
     * @param  int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * Create a new Model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create();

    /**
     * Save a newly created Model
     *
     * @param  array $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $input);

    /**
     * Update a Model by ID
     *
     * @param  int $id
     * @param  array $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $input);

    /**
     * Delete Models by ID returning a number of items removed
     *
     * @param  array $ids
     * @return int
     */
    public function destroy(array $ids);
}
