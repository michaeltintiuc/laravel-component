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
}
