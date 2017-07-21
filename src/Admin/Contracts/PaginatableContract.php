<?php
namespace MichaelT\Component\Admin\Contracts;

interface PaginatableContract
{
    /**
     * Get paginated results
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate();
}
