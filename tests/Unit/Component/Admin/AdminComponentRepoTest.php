<?php

namespace Tests;

use MichaelT\Component\Admin\ComponentRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Mockery;

class AdminComponentRepoTest extends TestCase
{
    private $adminRepo;
    private $modelMock;

    public function setUp()
    {
        parent::setUp();
        $this->modelMock = Mockery::mock(Model::class);
        $this->adminRepo = $this->getMockForAbstractClass(
            ComponentRepo::class,
            [$this->modelMock]
        );
    }

    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testGettingTheModel()
    {
        $result = $this->adminRepo->getModel();
        $this->assertEquals($this->modelMock, $result);
    }

    public function testCreating()
    {
        //This can't be unit tested as it is.
        $this->markTestIncomplete('Can\'t mock a constructor, would app->make be a better approach?');
        $method = self::getMethod('create', ComponentRepo::class);
        $result = $method->invokeArgs($this->adminRepo, []);
    }

    public function testSettingTheComponent()
    {
        $method = self::getMethod('setComponent', ComponentRepo::class);
        $component = 'foobar';
        $method->invokeArgs($this->adminRepo, [$component]);
        $result = self::getProperty('component', ComponentRepo::class)->getValue($this->adminRepo);
        $this->assertEquals(['component' => $component], $result);
    }

    public function testSettingPerPage()
    {
        $method = self::getMethod('getPerPage', ComponentRepo::class);
        $result = $method->invokeArgs($this->adminRepo, []);
        $perPage = self::getProperty('perPage', ComponentRepo::class)->getValue($this->adminRepo);
        $this->assertEquals($perPage, $result);
    }

    public function testGettingPerPage()
    {
        $method = self::getMethod('setPerPage', ComponentRepo::class);
        $perPage = 10;
        $method->invokeArgs($this->adminRepo, [$perPage]);
        $result = self::getProperty('perPage', ComponentRepo::class)->getValue($this->adminRepo);
        $this->assertEquals($perPage, $result);
    }

    public function testTheError()
    {
        $method = self::getMethod('error', ComponentRepo::class);
        $type = 'errorType';
        $component = 'test';

        $setComponentMethod = self::getMethod('setComponent', ComponentRepo::class);
        $setComponentMethod->invokeArgs($this->adminRepo, [$component]);
        Lang::shouldReceive('trans')
            ->once()
            ->with("exceptions.".$type, ['component' => $component], 'messages', null)
            ->andReturn('translatedError');
        $result = $method->invokeArgs($this->adminRepo, [$type]);
        $this->assertEquals('translatedError', $result);
    }
}
