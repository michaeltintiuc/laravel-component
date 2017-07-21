<?php
namespace App\Components\Stubs\Admin;

use MichaelT\Component\Admin\Contracts\RepoContract;
use MichaelT\Component\Admin\Contracts\SearchableContract;
use MichaelT\Component\Admin\Contracts\DestroyableContract;

interface StubsRepoContract extends RepoContract, SearchableContract, DestroyableContract
{
}
