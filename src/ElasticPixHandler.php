<?php
namespace Pomirleanu\ElasticIndexPix;

/**
 * User: pomir
 * Date: 2/24/2016
 * Time: 6:26 PM
 */
use ElasticIndexPix\Contracts\Search;
use Elasticsearch\Client;

class ElasticPixHandler
{
    /**
     * @var Elasticpix
     */
    protected $elasticpix;

    /**
     * @var string
     */
    protected $indexName;

    /**
     * ElasticPix constructor.
     * @param Client $elasticpix
     */
    public function __construct(Client $elasticpix)
    {
        $this->elasticpix = $elasticpix;
    }

    /**
     * Set the name of the index that should be used by default.
     *
     * @param $indexName
     *
     * @return $this
     */
    public function setIndexName($indexName)
    {
        $this->indexName = $indexName;

        return $this;
    }

    /**
     * Add or update the given search subject to the index.
     *
     * @param Search $subject
     */
    public function upsertToIndex(Search $subject)
    {
        $this->elasticpix->index(
            [
                'index' => $this->indexName,
                'type' => $subject->getSearchType(),
                'id' => $subject->getSearchId(),
                'body' => $subject->getSearchBody(),
            ]
        );
    }

    /**
     * Remove the given subject from the search index.
     *
     * @param Search $subject
     */
    public function removeFromIndex(Search $subject)
    {
        $this->elasticpix->delete(
            [
                'index' => $this->indexName,
                'type' => $subject->getSearchType(),
                'id' => $subject->getSearchId(),
            ]
        );
    }

    /**
     * Remove an item from the search index by type and id.
     *
     * @param string $type
     * @param int $id
     */
    public function removeFromIndexByTypeAndId($type, $id)
    {
        $this->elasticpix->delete(
            [
                'index' => $this->indexName,
                'type' => $type,
                'id' => $id,
            ]
        );
    }

    /**
     * Remove everything from the index.
     *
     * @return mixed
     */
    public function clearIndex()
    {
        $this->elasticpix->indices()->delete(['index' => $this->indexName]);
    }

    /**
     * Get the results for the given query.
     *
     * @param array $query
     *
     * @return mixed
     */
    public function getResults($query)
    {
        return $this->elasticpix->search($query);
    }

    /**
     * Count the results for the given query.
     *
     * @param array $query
     *
     * @return mixed
     */
    public function countResults($query)
    {
        return $this->elasticpix->count($query);
    }

    /**
     * Ping elastic to see if works.
     *
     * @param $query
     *
     * @return bool
     */
    public function ping($query)
    {
        return $this->elasticpix->ping($query);
    }

    /**
     * Verify the file existence on elastic based on type, index name and id.
     *
     * @param $query
     *
     * @return array|bool
     */
    public function exists($query)
    {
        return $this->elasticpix->exists($query);
    }

    /**
     * Get the underlying client.
     *
     * @return Elasticpix
     */
    public function getClient()
    {
        return $this->elasticpix;
    }
}