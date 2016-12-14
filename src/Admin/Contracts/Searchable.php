<?php

namespace MichaelT\Component\Admin\Contracts;

use Illuminate\Http\Request;

interface Searchable
{
    public function getSearch();
    public function postSearch(Request $request);
}
