<?php
namespace Pomirleanu\ElasticIndexPix;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Pomirleanu\ElasticIndexPix\Repo;
use Pomirleanu\ElasticIndexPix\Repo\ElasticPix;

/**
 * User: pomir
 * Date: 2/24/2016
 * Time: 5:31 PM
 */
class ElasticPixServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__ . '/../views'), 'index');
        $this->setupRoutes($this->app->router);
        $this->setupControllers();
        $this->publishes([
            __DIR__ . '/config/elastic-pix.php' => config_path('elastic-pix.php'),
        ]);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'pomirleanu\elasticIndexPix\Http\Controllers'], function ($router) {
            require __DIR__ . '/Http/routes.php';
        });
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind(Client::class, function () {
            $conf = $this->app['config']->get('elastic-pix');
            $logger = ClientBuilder::defaultLogger($conf['logPath'], $conf['logLevel']);
            $clientBuilder = ClientBuilder::create();
            $clientBuilder->setHosts($conf['hosts']);
            $clientBuilder->setRetries($conf['retries']);
            $clientBuilder->setLogger($logger);
            $client = $clientBuilder->build();

            return $client;
        });
    }
    private function setupControllers()
    {
        $this->app->make('Pomirleanu\ElasticIndexPix\Http\Controllers\ElasticController');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('elasticPix');
    }
}