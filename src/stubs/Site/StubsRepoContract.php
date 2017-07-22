<?php
namespace App\Components\Stubs\Site;

use MichaelT\Component\Site\Contracts\RepoContract;
use MichaelT\Component\Admin\Contracts\SearchableContract;
use MichaelT\Component\Admin\Contracts\PaginatableContract;

interface StubsRepoContract extends
    RepoContract,
    SearchableContract,
    PaginatableContract
{
}
