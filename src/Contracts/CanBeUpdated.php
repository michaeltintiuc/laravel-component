<?php
namespace MichaelT\Contracts;

interface CanBeUpdated
{
    /**
     * Update a Model by ID
     *
     * @param  int $id
     * @param  array $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $input);
}
