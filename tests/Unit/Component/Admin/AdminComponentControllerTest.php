<?php

namespace Tests;

use MichaelT\Component\Admin\ComponentController;
use MichaelT\Component\Admin\ComponentRepo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Mockery;

class AdminComponentControllerTest extends TestCase
{
    private $adminController;
    private $componentRepo;
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->componentRepo = Mockery::mock(ComponentRepo::class);
        $this->request = Mockery::mock(Request::class);
        $this->adminController = $this->getMockForAbstractClass(
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
        $sessionMessage = 'sessionMessage';
        $viewMock = Mockery::mock();
        View::shouldReceive('make')
            ->once()
            ->with('.viewName', [], [])
            ->andReturn($viewMock);
        $this->request->shouldReceive('session->get')
            ->once()
            ->with('message')
            ->andReturn($sessionMessage);
        $viewMock->shouldReceive('withMessage')
            ->once()
            ->with($sessionMessage)
            ->andReturn($viewMock);
        $result = $method->invokeArgs($this->adminController, [$view]);
        $this->assertEquals($viewMock, $result);
    }

    public function testRedirection()
    {
        $method = self::getMethod('redirect', ComponentController::class);
        $route = 'routeName';
        $params = ['params'];
        $redirectionMock = Mockery::mock();
        Redirect::ShouldReceive('route')
            ->once()
            ->with('.routeName', $params)
            ->andReturn($redirectionMock);
        $result = $method->invokeArgs($this->adminController, [$route, $params]);
        $this->assertEquals($result, $redirectionMock);
    }

    public function testInfo()
    {
        $method = self::getMethod('info', ComponentController::class);
        $type = 'infoType';
        $params = ['infoParams'];
        $component = 'test';

        $setComponentMethod = self::getMethod('setComponent', ComponentController::class);
        $setComponentMethod->invokeArgs($this->adminController, [$component]);
        $processedParams = [
            "component" => $component,
            0 => $params[0],
            "count" => count($params)
        ];

        Lang::shouldReceive('trans')
            ->once()
            ->with("info.".$type, $processedParams, 'messages', null)
            ->andReturn('translatedInfo');
        $result = $method->invokeArgs($this->adminController, [$type, $params]);
        $this->assertEquals('translatedInfo', $result);
    }

    public function testSettingTheComponent()
    {
        $method = self::getMethod('setComponent', ComponentController::class);
        $component = 'foobar';
        $method->invokeArgs($this->adminController, [$component]);
        $result = self::getProperty('component', ComponentController::class)->getValue($this->adminController);
        $this->assertEquals(['component' => $component], $result);
    }

    public function testSettingTheBaseView()
    {
        $method = self::getMethod('setBaseView', ComponentController::class);
        $baseView = 'foobar';
        $method->invokeArgs($this->adminController, [$baseView]);
        $result = self::getProperty('baseView', ComponentController::class)->getValue($this->adminController);
        $this->assertEquals($baseView, $result);
    }

    public function testSettingTheTitle()
    {
        $method = self::getMethod('setTitle', ComponentController::class);
        $prefix = 'prefix';
        $title = 'title';
        View::ShouldReceive('share')
            ->once()
            ->with('title', $prefix . ' - ' . $title);
        $result = $method->invokeArgs($this->adminController, [$title, $prefix]);
    }

    public function testSettingTheHeading()
    {
        $method = self::getMethod('setHeading', ComponentController::class);
        $heading = 'heading';
        View::ShouldReceive('share')
            ->once()
            ->with('heading', $heading);
        $result = $method->invokeArgs($this->adminController, [$heading]);
    }

    public function testSettingTheSearchRoute()
    {
        $method = self::getMethod('setSearchRoute', ComponentController::class);
        $route = 'route';
        View::shouldReceive('share')
            ->once()
            ->with('searchRoute', $route);
        $result = $method->invokeArgs($this->adminController, [$route]);
    }
}
