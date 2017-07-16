<?php
namespace MichaelT\Component\Admin\Contracts;

interface SearchableContract
{
    /**
     * Search Models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($query);
}
