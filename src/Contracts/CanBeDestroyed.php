<?php
namespace MichaelT\Contracts;

interface CanBeDestroyed
{
    /**
     * Delete Models by ID returning a number of items removed
     *
     * @param  array $ids
     * @return int
     */
    public function destroy(array $ids);
}
