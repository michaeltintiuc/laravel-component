<?php
namespace App\Components\Stubs\Admin;

use MichaelT\Component\Admin\Contracts\RepoContract;
use MichaelT\Component\Admin\Contracts\CanBeDestroyed;
use MichaelT\Component\Admin\Contracts\Searchable;
use MichaelT\Component\Admin\Contracts\HasPages;

interface StubsRepoContract extends RepoContract, CanBeDestroyed, Searchable, HasPages
{
}
