<?php

namespace MichaelT\Component\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class ComponentController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repo;
    private $request;
    private $component;
    private $baseView;

    function __construct(Request $request, ComponentRepo $repo)
    {
        $this->request = $request;
        $this->repo = $repo;
    }

    final protected function view($view)
    {
        return view($this->baseView.'.'.$view)
            ->withMessage($this->request->session()->get('message'));
    }

    final protected function redirect($route, $params = [])
    {
        return redirect()->route($this->baseView.'.'.$route, $params);
    }

    final protected function info($type, array $params = [])
    {
        $params = $this->component + $params + ['count' => 1];

         if ($params['count'] > 1 || $params['count'] == 0)
            $params['component'] = str_plural($params['component']);

        return trans("info.$type", $params);
    }

    final protected function setComponent($component)
    {
        $this->component = ['component' => $component];
    }

    final protected function setBaseView($baseView)
    {
        $this->baseView = $baseView;
    }

    final protected function setTitle($title)
    {
        view()->share('title', "TWA - Admin - $title");
    }

    final protected function setHeading($heading)
    {
        view()->share('heading', $heading);
    }
}
