<?php

namespace MichaelT\Component\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ComponentRepoContract
{
    public function all();
    public function paginate();
    public function find($id);
    public function create();
    public function store(array $input);
    public function update($id, array $input);
    public function destroy(array $ids);
}
