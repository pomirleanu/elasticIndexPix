<?php
namespace Pomirleanu\ElasticIndexPix;

use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Pomirleanu\ElasticIndexPix\Repo;

/**
 * User: pomir
 * Date: 2/24/2016
 * Time: 5:31 PM
 */
class ElasticPixServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;
        if (version_compare($app::VERSION, '5.0') >= 0) {
            // Laravel 5
            $configPath = realpath(__DIR__ . '/../config/elasticsearch.php');
            $this->publishes([
                $configPath => config_path('elasticsearch.php')
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $app->singleton('elasticPix.factory', function ($app) {
            return new Factory();
        });
        $app->singleton('elasticPix', function ($app) {
            return new Manager($app, $app['elasticPix.factory']);
        });
        $app->singleton(\Elasticsearch\Client::class, function ($app) {
            return $app['elasticPix']->connection();
        });
    }
}