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
class ElasticPixServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/elastic-pix.php' => config_path('elastic-pix.php'),
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('elasticPix', function ($app) {
            $conf = $this->app['config']->get('elastic-pix');
            $clientBuilder = ClientBuilder::create();
            $clientBuilder->setHosts($conf['hosts']);
//            $clientBuilder->setRetries(2);
            if($conf['logEnable']){
                $logger = ClientBuilder::defaultLogger($conf['logPath'], $conf['logLevel']);
                $clientBuilder->setLogger($logger);
            }
            $client = $clientBuilder->build();

            return $client;
        });
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