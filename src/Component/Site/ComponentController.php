<?php
namespace MichaelT\Component\Site;

use Illuminate\Http\Request;
use MichaelT\Component\Admin\ComponentController as AdminComponentController;

abstract class ComponentController extends AdminComponentController
{
    /**
     * {@inheritDoc}
     */
    public function __construct(Request $request, ComponentRepo $repo)
    {
        $this->request = $request;
        $this->repo = $repo;
    }

    /**
     * {@inheritDoc}
     */
    protected function view($view)
    {
        return view($this->baseView.'.'.$view);
    }

    /**
     * {@inheritDoc}
     */
    protected function setTitle($title, $prefix = '')
    {
        parent::setTitle($title, $prefix);
    }
}
