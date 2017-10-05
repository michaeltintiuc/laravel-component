<?php

namespace Tests;

use App\Components\Stubs\Site\StubsController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\RouteCollection;
use App\Components\Stubs\Site\StubsRepo;
use App\Components\Stubs\Stub;
use Mockery;

class SiteComponentIntegrationTest extends TestCase
{
    private $siteController;
    private $siteRepo;
    private $siteRequest;
    private $session;

    public function setUp()
    {
        parent::setUp();

        Schema::create('stubs', function (Blueprint $table) {
            $table->increments('id');
        });

        $this->stub = new Stub();
        $this->session = app('session');

        $this->siteRequest = new Request();
        $this->siteRequest->setSession($this->session->driver());
        $this->siteRequest->session()->set('message', 'testMessage');

        $this->siteRepo = new StubsRepo($this->stub);
        $this->siteController = new StubsController($this->siteRequest, $this->siteRepo);
    }

    public function testIndex()
    {
        $viewMock = Mockery::mock();
        View::shouldReceive('share')
            ->times()
            ->with("title", " - Search stubs");
        View::shouldReceive('share')
            ->times()
            ->with("title", " - All stubs");
        View::shouldReceive('share')
            ->times()
            ->with("heading", "Stubs list");
        View::shouldReceive('make')
            ->once()
            ->with("site.stubs.index", [], [])
            ->andReturn($viewMock);
        $stubs = $this->siteRepo->all();
        $viewMock->shouldReceive('with')
            ->once()
            ->with(compact('stubs'))
            ->andReturn($viewMock);
        $result = $this->siteController->index($this->siteRequest);
        $this->assertEquals($viewMock, $result);
    }

    public function testSearch()
    {
        $query = 'searchQuery';
        $viewMock = Mockery::mock();
        View::shouldReceive('share')
            ->once()
            ->with("title", " - Search stubs");
        View::shouldReceive('share')
            ->once()
            ->with("heading", "Stubs search");
        View::shouldReceive('make')
            ->once()
            ->with("site.stubs.index", [], [])
            ->andReturn($viewMock);
        $stubs = $this->siteRepo->search($query);
        $viewMock->shouldReceive('with')
            ->once()
            ->with(compact('stubs'))
            ->andReturn($viewMock);
        $result = $this->siteController->search($query);
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
            ->with("site.stubs.create", [], [])
            ->andReturn($viewMock);
        $viewMock->shouldReceive('withMessage')
            ->once()
            ->with("testMessage")
            ->andReturn($viewMock);
        //$stub = $this->siteRepo->find(1);
        $viewMock->shouldReceive('with')
            ->once()
            ->with(compact('stub'))
            ->andReturn($viewMock);
        $result = $this->siteController->show(1);
        $this->assertEquals($viewMock, $result);
    }
}
