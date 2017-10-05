<?php

namespace Tests;

use App\Components\Stubs\Admin\StubsController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\RouteCollection;
use Illuminate\Http\Request;
use App\Components\Stubs\Admin\StubsRepo;
use App\Components\Stubs\Admin\Requests\UpdateStubsRequest;
use App\Components\Stubs\Admin\Requests\DestroyStubsRequest;
use App\Components\Stubs\Stub;
use Mockery;

class AdminComponentIntegrationTest extends TestCase
{
    private $adminController;
    private $adminRepo;
    private $adminRequest;
    private $session;

    public function setUp()
    {
        parent::setUp();

        Schema::create('stubs', function (Blueprint $table) {
            $table->increments('id');
        });

        $this->stub = new Stub();
        $this->session = app('session');

        $this->adminRequest = new Request();
        $this->adminRequest->setSession($this->session->driver());
        $this->adminRequest->session()->set('message', 'testMessage');

        $this->adminRepo = new StubsRepo($this->stub);
        $this->adminController = new StubsController($this->adminRequest, $this->adminRepo);
    }

    public function testIndex()
    {
        $viewMock = Mockery::mock();
        View::shouldReceive('share')
            ->once()
            ->with("title", "Admin - All stubs");
        View::shouldReceive('share')
            ->once()
            ->with("heading", "Stubs list");
        View::shouldReceive('make')
            ->once()
            ->with("admin.stubs.index", [], [])
            ->andReturn($viewMock);
        $viewMock->shouldReceive('withMessage')
            ->once()
            ->with("testMessage")
            ->andReturn($viewMock);
        $stubs = $this->adminRepo->all();
        $viewMock->shouldReceive('with')
            ->once()
            ->with(compact('stubs'))
            ->andReturn($viewMock);
        $result = $this->adminController->index($this->adminRequest);
        $this->assertEquals($viewMock, $result);
    }

    public function testSearch()
    {
        $query = 'searchQuery';
        $viewMock = Mockery::mock();
        View::shouldReceive('share')
            ->once()
            ->with("title", "Admin - Search stubs");
        View::shouldReceive('share')
            ->once()
            ->with("heading", "Stubs search");
        View::shouldReceive('make')
            ->once()
            ->with("admin.stubs.index", [], [])
            ->andReturn($viewMock);
        $viewMock->shouldReceive('withMessage')
            ->once()
            ->with("testMessage")
            ->andReturn($viewMock);
        $stubs = $this->adminRepo->search($query);
        $viewMock->shouldReceive('with')
            ->once()
            ->with(compact('stubs'))
            ->andReturn($viewMock);
        $result = $this->adminController->search($query);
        $this->assertEquals($viewMock, $result);
    }

    public function testCreate()
    {
        $this->markTestIncomplete('The create method for the repo is protected');
        $viewMock = Mockery::mock();
        View::shouldReceive('share')
            ->once()
            ->with("title", "Admin - Stubs - New");
        View::shouldReceive('share')
            ->once()
            ->with("heading", "Creating stub");
        View::shouldReceive('make')
            ->once()
            ->with("admin.stubs.create", [], [])
            ->andReturn($viewMock);
        $viewMock->shouldReceive('withMessage')
            ->once()
            ->with("testMessage")
            ->andReturn($viewMock);
        $stub = $this->adminRepo->create();
        $viewMock->shouldReceive('with')
            ->once()
            ->with(compact('stub'))
            ->andReturn($viewMock);
        $result = $this->adminController->create();
        $this->assertEquals($viewMock, $result);
    }

    public function testShow()
    {
        $this->markTestIncomplete('I didnt found a way to actually search stubs');
        $viewMock = Mockery::mock();
        View::shouldReceive('share')
            ->once()
            ->with("title", "Stubs - ");
        View::shouldReceive('share')
            ->once()
            ->with("heading", "Viewing stub");
        View::shouldReceive('make')
            ->once()
            ->with("admin.stubs.create", [], [])
            ->andReturn($viewMock);
        $viewMock->shouldReceive('withMessage')
            ->once()
            ->with("testMessage")
            ->andReturn($viewMock);
        //$stub = $this->adminRepo->find(1);
        $viewMock->shouldReceive('with')
            ->once()
            ->with(compact('stub'))
            ->andReturn($viewMock);
        $result = $this->adminController->show(1);
        $this->assertEquals($viewMock, $result);
    }

    public function testEdit()
    {
        $this->markTestIncomplete('I didnt found a way to actually search stubs');
        $viewMock = Mockery::mock();
        View::shouldReceive('share')
            ->once()
            ->with("title", "Stubs - ");
        View::shouldReceive('share')
            ->once()
            ->with("heading", "Editing stub");
        View::shouldReceive('make')
            ->once()
            ->with("admin.stubs.create", [], [])
            ->andReturn($viewMock);
        $viewMock->shouldReceive('withMessage')
            ->once()
            ->with("testMessage")
            ->andReturn($viewMock);
        //$stub = $this->adminRepo->find(1);
        $viewMock->shouldReceive('with')
            ->once()
            ->with(compact('stub'))
            ->andReturn($viewMock);
        $result = $this->adminController->edit(1);
        $this->assertEquals($viewMock, $result);
    }

    public function testUpdate()
    {
        $this->markTestIncomplete('I didnt found a way to actually update stubs');
        $viewMock = Mockery::mock();
        View::shouldReceive('share')
            ->once()
            ->with("title", "Stubs - ");
        View::shouldReceive('share')
            ->once()
            ->with("heading", "Viewing stub");
        View::shouldReceive('make')
            ->once()
            ->with("admin.stubs.create", [], [])
            ->andReturn($viewMock);
        $viewMock->shouldReceive('withMessage')
            ->once()
            ->with("testMessage")
            ->andReturn($viewMock);
        //$stub = $this->adminRepo->find(1);
        $viewMock->shouldReceive('with')
            ->once()
            ->with(compact('stub'))
            ->andReturn($viewMock);
        $result = $this->adminController->update(new UpdateStubsRequest());
        $this->assertEquals($viewMock, $result);
    }

    public function testDestroy()
    {
        $stubId = 1;
        Auth::shouldReceive('stub')
            ->once()
            ->with()
            ->andReturn((object)['id' => $stubId]);
        $routingMock = Mockery::mock(RouteCollection::class);
        Route::shouldReceive('getRoutes')
            ->once()
            ->with()
            ->andReturn($routingMock);
        $routingMock->shouldReceive('getByName')
            ->once()
            ->with('admin.stubs.index')
            ->andReturn($routingMock);
        $routingMock->shouldReceive('domain', 'httpOnly')
            ->times(2)
            ->with()
            ->andReturn($routingMock);
        $routingMock->shouldReceive('uri')
            ->once()
            ->with()
            ->andReturn($routingMock);
        $result = $this->adminController->destroy($stubId);
        $this->assertEquals(
            \Illuminate\Http\RedirectResponse::class,
            get_class($result)
        );
    }

    public function testDestroyMultiple()
    {
        $stubId = 1;
        Auth::shouldReceive('stub')
            ->once()
            ->with()
            ->andReturn((object)['id' => $stubId]);
        $routingMock = Mockery::mock(RouteCollection::class);
        Route::shouldReceive('getRoutes')
            ->once()
            ->with()
            ->andReturn($routingMock);
        $routingMock->shouldReceive('getByName')
            ->once()
            ->with('admin.stubs.index')
            ->andReturn($routingMock);
        $routingMock->shouldReceive('domain', 'httpOnly')
            ->times(2)
            ->with()
            ->andReturn($routingMock);
        $routingMock->shouldReceive('uri')
            ->once()
            ->with()
            ->andReturn($routingMock);
        $result = $this->adminController->destroyMultiple(new DestroyStubsRequest(['ids' => [1,2]]));
        $this->assertEquals(
            \Illuminate\Http\RedirectResponse::class,
            get_class($result)
        );
    }
}
