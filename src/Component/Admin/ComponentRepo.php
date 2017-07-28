<?php
namespace MichaelT\Component\Admin;

use Illuminate\Database\Eloquent\Model;

abstract class ComponentRepo
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    private $model;

    /**
     * @var string
     */
    private $component;

    /**
     * @var int
     */
    private $perPage = 25;

    /**
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new Model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function create()
    {
        return new $this->model();
    }

    /**
     * Find a Model by ID
     *
     * @param  mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract public function find($id);

    /**
     * Get model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set component
     *
     * @param  string $component
     * @return void
     */
    final protected function setComponent($component)
    {
        $this->component = ['component' => $component];
    }

    /**
     * Set per page count
     *
     * @param  string $perPage
     * @return void
     */
    final protected function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    /**
     * Get per page count
     *
     * @return int
     */
    final protected function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * Get an error message by controller
     *
     * @param  string $type
     * @return string
     */
    final protected function error($type)
    {
        return trans("exceptions.$type", $this->component);
    }
}
