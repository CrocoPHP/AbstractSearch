<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 24/06/16
 * Time: 09:00
 */

namespace oat\taoSearch\model\search;

/**
 * Interface QueryBuilderInterface
 * use to create query from user data
 *
 * @package oat\taoSearch\model\search
 */
interface QueryBuilderInterface {

    /**
     * change default query param className
     * @param string $queryClassName
     * @return $this
     */
    public function setQueryClassName($queryClassName);

    /**
     * change default query param factory
     * @param callable $factory
     * @return $this
     */
    public function setQueryFactory(callable $factory);

    /**
     * return query params list as array of QueryInterface
     * @return array
     */
    public function getStoredQueries();
    
    /**
     * create a new query and stored it
     * @return QueryInterface
     */
    public function newQuery();
   
}