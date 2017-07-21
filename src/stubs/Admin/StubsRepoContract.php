<?php
namespace App\Components\Stubs\Admin;

use MichaelT\Component\Admin\Contracts\RepoContract;
use MichaelT\Component\Admin\Contracts\SearchableContract;
use MichaelT\Component\Admin\Contracts\DestroyableContract;
use MichaelT\Component\Admin\Contracts\PaginatableContract;

interface StubsRepoContract extends
    RepoContract,
    SearchableContract,
    DestroyableContract,
    PaginatableContract
{
}
