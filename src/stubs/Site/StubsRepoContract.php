<?php
namespace App\Components\Stubs\Site;

use MichaelT\Component\Site\Contracts\RepoContract;
use MichaelT\Component\Admin\Contracts\Searchable;
use MichaelT\Component\Admin\Contracts\HasPages;

interface StubsRepoContract extends RepoContract, Searchable, HasPages
{
}
