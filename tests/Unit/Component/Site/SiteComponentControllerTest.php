<?php

namespace Tests;

use MichaelT\Component\Site\ComponentController;
use MichaelT\Component\Site\ComponentRepo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Mockery;

class SiteComponentControllerTest extends TestCase
{
    private $siteComponent;
    private $componentRepo;
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->componentRepo = Mockery::mock(ComponentRepo::class);
        $this->request = Mockery::mock(Request::class);
        $this->siteController = $this->getMockForAbstractClass(
            ComponentController::class,
            [$this->request, $this->componentRepo]
        );
    }

    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testViewGeneration()
    {
        $method = self::getMethod('view', ComponentController::class);
        $view = 'viewName';
        $viewMock = Mockery::mock();
        View::shouldReceive('make')
            ->once()
            ->with('.viewName', [], [])
            ->andReturn($viewMock);
        $result = $method->invokeArgs($this->siteController, [$view]);
        $this->assertEquals($viewMock, $result);
    }

    public function testSettingTheTitle()
    {
        $method = self::getMethod('setTitle', ComponentController::class);
        $prefix = 'prefix';
        $title = 'title';
        View::ShouldReceive('share')
            ->once()
            ->with('title', $prefix . ' - ' . $title);
        $result = $method->invokeArgs($this->siteController, [$title, $prefix]);
    }
}
