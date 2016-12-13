<?php

namespace MichaelT\Component\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ComponentRepoContract
{
    public function all(): Collection;
    public function paginate(): LengthAwarePaginator;
    public function find(int $id): Model;
    public function create(): Model;
    public function store(array $input): Model;
    public function update(int $id, array $input): Model;
    public function destroy(array $ids): int;
}
