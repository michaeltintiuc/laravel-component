<?php
namespace MichaelT\Component\Site\Contracts;

interface RepoContract
{
    /**
     * {@inheritDoc}
     */
    public function all();

    /**
     * {@inheritDoc}
     */
    public function find($id);
}
