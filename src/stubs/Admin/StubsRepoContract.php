<?php
namespace App\Components\Stubs\Admin;

use MichaelT\Contracts\RepoContract;
use MichaelT\Contracts\CanBeCreated;
use MichaelT\Contracts\CanBeUpdated;
use MichaelT\Contracts\CanBeDestroyed;
use MichaelT\Contracts\Searchable;
use MichaelT\Contracts\HasPages;

interface StubsRepoContract extends
    RepoContract,
    CanBeCreated,
    CanBeUpdated,
    CanBeDestroyed,
    Searchable,
    HasPages
{
}
