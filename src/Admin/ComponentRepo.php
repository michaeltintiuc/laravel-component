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

    final protected function setComponent(string $component)
    {
        $this->component = ['component' => $component];
    }

    final protected function setPerPage(int $perPage)
    {
        $this->perPage = $perPage;
    }

    final protected function getPerPage(): int
    {
        return $this->perPage;
    }

    final protected function error(string $type): string
    {
        return trans("exceptions.$type", $this->component);
    }
}
