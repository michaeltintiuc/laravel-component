<?php
namespace MichaelT\Component\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class ComponentController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var ComponentRepo
     */
    protected $repo;

    /**
     * @var string
     */
    protected $baseView;

    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * @var string
     */
    private $component;

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  ComponentRepo $repo
     * @return void
     */
    public function __construct(Request $request, ComponentRepo $repo)
    {
        $this->request = $request;
        $this->repo = $repo;
    }

    /**
     * Generate the view from the components base
     *
     * @param  string $view
     * @return \Illuminate\View\View
     */
    protected function view($view)
    {
        return view($this->baseView.'.'.$view)
            ->withMessage($this->request->session()->get('message'));
    }

    /**
     * Redirect to a component route
     *
     * @param  string $route
     * @param  array $params
     * @return \Illuminate\Http\RedirectResponse
     */
    final protected function redirect($route, $params = [])
    {
        return redirect()->route($this->baseView.'.'.$route, $params);
    }

    /**
     * Generate an info message with count
     *
     * @param  string $type
     * @param  array $params
     * @return string
     */
    final protected function info($type, array $params = [])
    {
        $params = $this->component + $params + ['count' => 1];

        if ($params['count'] > 1 || $params['count'] == 0) {
            $params['component'] = str_plural($params['component']);
        }

        return trans("info.$type", $params);
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
     * Set base view
     *
     * @param  string $baseView
     * @return void
     */
    final protected function setBaseView($baseView)
    {
        $this->baseView = $baseView;
    }

    /**
     * Send the title to the view
     *
     * @param  string $title
     * @return void
     */
    protected function setTitle($title)
    {
        view()->share('title', "Admin - $title");
    }

    /**
     * Send the heading to the view
     *
     * @param  string $heading
     * @return void
     */
    final protected function setHeading($heading)
    {
        view()->share('heading', $heading);
    }

    /**
     * Send the search route to the view
     *
     * @param  string $route
     * @return void
     */
    final protected function setSearchRoute($route)
    {
        view()->share('searchRoute', $route);
    }
}
