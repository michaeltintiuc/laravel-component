<?php
namespace App\Components\Stubs\Site;

use MichaelT\Contracts\RepoContract;
use MichaelT\Contracts\Searchable;
use MichaelT\Contracts\HasPages;

interface StubsRepoContract extends RepoContract, Searchable, HasPages
{
}
