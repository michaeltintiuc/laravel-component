<?php
namespace MichaelT\Component\Site;

use Illuminate\Http\Request;

abstract class ComponentController extends \MichaelT\Component\Admin\ComponentController
{
    public function __construct(Request $request, ComponentRepo $repo)
    {
        $this->request = $request;
        $this->repo = $repo;
    }
}
