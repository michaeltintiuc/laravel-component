<?php
namespace MichaelT\Component\Admin;

use Illuminate\Database\Eloquent\Model;

abstract class ComponentRepo
{
    protected $model;
    private $component;
    private $perPage = 25;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    final protected function setComponent($component)
    {
        $this->component = ['component' => $component];
    }

    final protected function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    final protected function getPerPage()
    {
        return $this->perPage;
    }

    final protected function error($type)
    {
        return trans("exceptions.$type", $this->component);
    }
}
