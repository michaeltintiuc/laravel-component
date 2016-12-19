<?php
namespace MichaelT\Component\Site\Contracts;

interface RepoContract
{
    public function all();
    public function paginate();
    public function find($id);
}
