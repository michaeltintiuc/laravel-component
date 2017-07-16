<?php
namespace MichaelT\Component\Admin;

use Illuminate\Database\Eloquent\Model;

abstract class ComponentRepo
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

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
