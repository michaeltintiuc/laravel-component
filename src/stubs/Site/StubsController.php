<?php
namespace App\Components\Stubs\Site;

use Illuminate\Http\Request;
use MichaelT\Components\Site\ComponentController;
use App\Components\Stubs\Site\Requests\StoreStubsRequest;
use App\Components\Stubs\Site\Requests\UpdateStubsRequest;

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
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $stub = $this->repo->create();
        $this->setTitle('Stubs - New');
        $this->setHeading('Creating stub');

        return $this->view('create')->with(compact('stub'));
    }

    /**
     * Create stub
     *
     * @param
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $stub = $this->repo->find((int) $id);
        $this->setTitle("Stubs - $stub->name");
        $this->setHeading("Viewing stub $stub->name");

        return $this->view('show')->with(compact('stub'));
    }

    /**
     * Edit stub
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $stub = $this->repo->find((int) $id);
        $this->setTitle("Stubs - $stub->name");
        $this->setHeading("Editing stub $stub->name");

        return $this->view('edit')->with(compact('stub'));
    }

    /**
     * Save stub
     *
     * @param  \App\Components\Stubs\Site\StoreStubsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStubsRequest $request)
    {
        $stub = $this->repo->store($request->all());

        return $this->redirect('show', $stub->id)
            ->withMessage($this->info('store'));
    }

    /**
     * Update stub
     *
     * @param  \App\Components\Stubs\Site\UpdateStubsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStubsRequest $request, $id)
    {
        $stub = $this->repo->update($id, $request->all());

        return $this->redirect('show', $stub->id)
            ->withMessage($this->info('update'));
    }
}
