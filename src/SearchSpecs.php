<?php
namespace Pomirleanu\ElasticIndexPix;
/**
 * User: Pomirleanu
 * Date: 2/25/2016
 * Time: 8:26 AM
 */
use Elasticsearch\Client;
use ElasticIndexPix\Contracts\Search;
use PhpSpec\ObjectBehavior;

class SearchSpecs extends ObjectBehavior
{
    protected $indexName;
    protected $searchableBody;
    protected $searchableType;
    protected $searchableId;

    protected $searchableObject;

    public function __construct()
    {
        $this->indexName = 'indexName';

        $this->searchableBody = ['body' => 'test'];
        $this->searchableType = 'product';
        $this->searchableId = 1;
    }

    public function let(Client $elasticpix, Search $searchableObject)
    {
        $searchableObject->getSearchBody()->willReturn($this->searchableBody);
        $searchableObject->getSearchType()->willReturn($this->searchableType);
        $searchableObject->getSearchId()->willReturn($this->searchableId);

        $this->beConstructedWith($elasticpix);

        $this->setIndexName($this->indexName);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Pomirleanu\ElasticIndexPix\ElasticPixHandler');
    }

    public function it_adds_a_searchable_object_to_the_search_index(Client $elasticpix, Search $searchableObject)
    {
        $elasticpix->index(
            [
                'index' => $this->indexName,
                'type' => $this->searchableType,
                'id' => $this->searchableId,
                'body' => $this->searchableBody,
            ]
        )->shouldBeCalled();

        $this->upsertToIndex($searchableObject);
    }

    public function it_removes_a_searchable_object_from_the_index(Client $elasticpix, Search $searchableObject)
    {
        $elasticpix->delete(
            [
                'index' => $this->indexName,
                'type' => $this->searchableType,
                'id' => $this->searchableId,
            ]
        )->shouldBeCalled();

        $this->removeFromIndex($searchableObject);
    }

    public function it_an_object_from_the_index_by_type_and_id(Client $elasticpix)
    {
        $elasticpix->delete(
            [
                'index' => $this->indexName,
                'type' => $this->searchableType,
                'id' => $this->searchableId,
            ]
        )->shouldBeCalled();

        $this->removeFromIndexByTypeAndId($this->searchableType, $this->searchableId);
    }

    /*
     * Need to figure how to test the clearIndex function
     *
        function it_can_clear_the_index(Client $elasticpix)
        {

            $elasticpix->indices()->delete(['index' => $this->indexName]);

            $this->clearIndex();
        }
    */

    public function it_can_get_search_results(Client $elasticpix)
    {
        $query = 'this is a testquery';

        $elasticpix->search($query)->shouldBeCalled();

        $this->getResults($query);
    }

    public function it_can_count_search_results(Client $elasticpix)
    {
        $query = 'this is a testquery';

        $elasticpix->count($query)->shouldBeCalled();

        $this->countResults($query);
    }
}