<?php
namespace Pomirleanu\ElasticIndexPix\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Pomirleanu\ElasticIndexPix\ElasticPixHandler;

/**
 * User: Pomirleanu
 * Date: 2/25/2016
 * Time: 7:50 AM
 */
class ElasticController extends Controller
{
    /**
     * @var ElasticPixHandler
     */
    private $elasticPix;

    /**
     * ElasticController constructor.
     * @param ElasticPixHandler $elasticPix
     */
    public function __construct(ElasticPixHandler $elasticPix)
    {
        $this->elasticPix = $elasticPix;
        $this->config = Config::get('elastic-pix');
        $this->elasticPix->setIndexName(Config::get('elastic-pix.defaultIndexName'));
    }

    public function index()
    {
        $status = $this->elasticPix->ping([]);
        if ($status) {
            dd('Your server looks good');
        };
    }
}