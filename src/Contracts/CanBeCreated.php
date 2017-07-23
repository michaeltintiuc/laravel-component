<?php
namespace MichaelT\Contracts;

interface CanBeCreated
{
    /**
     * Save a newly created Model
     *
     * @param  array $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $input);    
}
