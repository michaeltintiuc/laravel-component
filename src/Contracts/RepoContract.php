<?php
namespace MichaelT\Contracts;

interface RepoContract
{
    /**
     * Get all results
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find a Model by ID
     *
     * @param  int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id);
}
