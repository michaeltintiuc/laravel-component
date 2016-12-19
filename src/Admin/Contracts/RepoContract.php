<?php
namespace MichaelT\Component\Admin\Contracts;

interface RepoContract
{
    public function all();
    public function paginate();
    public function find($id);
    public function create();
    public function store(array $input);
    public function update($id, array $input);
    public function destroy(array $ids);
}
