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

    protected function view($view)
    {
        return view($this->baseView.'.'.$view);
    }

    protected function setTitle($title)
    {
        view()->share('title', $title);
    }
}
