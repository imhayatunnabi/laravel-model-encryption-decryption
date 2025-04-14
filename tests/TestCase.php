<?php

namespace Imhayatunnabi\LaravelHashes\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Support\Facades\Schema;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function setUpDatabase()
    {
        Schema::create('test_models', function ($table) {
            $table->id();
            $table->string('name');
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->timestamps();
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            \Imhayatunnabi\LaravelHashes\LaravelHashesServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    public function artisan($command, $parameters = [])
    {
        return $this->app['artisan']->call($command, $parameters);
    }

    public function call($method, $uri, $parameters = [], $files = [], $server = [], $content = null, $changeHistory = true)
    {
        return $this->app['router']->dispatch($this->createRequest($method, $uri, $parameters, $files, $server, $content));
    }

    public function seed($class = 'DatabaseSeeder')
    {
        $this->artisan('db:seed', ['--class' => $class]);
    }
} 