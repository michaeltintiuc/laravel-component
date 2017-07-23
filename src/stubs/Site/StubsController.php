<?php
namespace App\Components\Stubs\Site;

use Illuminate\Http\Request;
use MichaelT\Component\Site\ComponentController;

class StubsController extends ComponentController
{
    /**
     * Initialize StubsController
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Components\Stubs\Site\StubsRepo $repo
     * @return void
     */
    public function __construct(Request $request, StubsRepo $repo)
    {
        parent::__construct($request, $repo);
        $this->setComponent('stub');
        $this->setBaseView('site.stubs');
        $this->setSearchRoute('site.stubs.index');
    }

    /**
     * List stubs and search delegation
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            return $this->search($request->search);
        }

        $stubs = $this->repo->all();
        $this->setTitle('All stubs');
        $this->setHeading('Stubs list');

        return $this->view('index')->with(compact('stubs'));
    }

    /**
     * Search stubs
     *
     * @param  string $query
     * @return \Illuminate\View\View
     */
    public function search($query)
    {
        $stubs = $this->repo->search($query);
        $this->setTitle('Search stubs');
        $this->setHeading('Stubs search');

        return $this->view('index')->with(compact('stubs'));
    }

    /**
     * Create stub
     *
     * @param  string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $stub = $this->repo->find($slug);
        $this->setTitle("Stubs - $stub->name");
        $this->setHeading("Viewing stub $stub->name");

        return $this->view('show')->with(compact('stub'));
    }
}
