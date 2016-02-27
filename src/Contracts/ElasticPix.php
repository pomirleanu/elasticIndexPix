<?php
namespace Pomirleanu\ElasticIndexPix\Contracts;
/**
 * User: pomir
 * Date: 2/24/2016
 * Time: 6:26 PM
 */

interface ElasticPix
{
    /**
     * Get the results for the given query.
     *
     * @param $query
     *
     * @return mixed
     */
    public function getResults($query);

    /**
     * Count the results for the given query.
     *
     * @param $query
     *
     * @return mixed
     */
    public function countResults($query);

    /**
     * Add or update the given Search subject to the index.
     *
     * @param Search $subject
     */
    public function upsertToIndex(Search $subject);

    /**
     * Remove the given subject from the search index.
     *
     * @param Search $subject
     */
    public function removeFromIndex(Search $subject);

    /**
     * Remove an item from the search index by type and id.
     *
     * @param string $type
     * @param int    $id
     */
    public function removeFromIndexByTypeAndId($type, $id);

    /**
     * Remove everything from the index.
     *
     * @return mixed
     */
    public function clearIndex();

    /**
     * Get the underlying client.
     *
     * @return mixed
     */
    public function getClient();
}