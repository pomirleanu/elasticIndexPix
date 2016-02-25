<?php
/**
 * User: pomir
 * Date: 2/24/2016
 * Time: 7:17 PM
 */

namespace ElasticIndexPix\Contracts;


interface Search
{
    /**
     * Returns an array with properties which must be indexed.
     *
     * @return array
     */
    public function getSearchBody();

    /**
     * Return the type of the search subject.
     *
     * @return string
     */
    public function getSearchType();

    /**
     * Return the id of the search subject.
     *
     * @return string
     */
    public function getSearchId();
}