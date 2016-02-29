<?php
namespace Pomirleanu\ElasticIndexPix;

/**
 * User: Pomirleanu
 * Date: 2/25/2016
 * Time: 8:19 AM
 */
use Illuminate\Support\Facades\Facade;

class ElasticPixFacade extends  Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'elasticPix';
    }
}
