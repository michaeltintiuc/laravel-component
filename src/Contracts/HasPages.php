<?php
namespace MichaelT\Contracts;

interface HasPages
{
    /**
     * Get paginated results
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate();
}
