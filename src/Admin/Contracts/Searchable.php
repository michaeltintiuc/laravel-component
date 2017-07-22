<?php
namespace MichaelT\Component\Admin\Contracts;

interface Searchable
{
    /**
     * Search Models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($query);
}
