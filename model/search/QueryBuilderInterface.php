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
     * @param string $queryParamsClassName
     * @return $this
     */
    public function setQueryParamClassName($queryParamsClassName);

    /**
     * change default query param factory
     * @param callable $factory
     * @return $this
     */
    public function setQueryParamFactory(callable $factory);

    /**
     * return query params list as array of QueryParamInterface
     * @return array
     */
    public function getQuery();

    /**
     * create and store a new QueryParamInterface
     * @param string $name
     * @param string $operator
     * @param mixed $value
     * @param bool $andSeparator true for and , false for or
     * @return QueryParamInterface
     */
    public function addOperation($name , $operator , $value , $andSeparator = true);

    /**
     * set query limit
     *
     * @param int $start
     * @param int $offset
     * @return $this
     */
    public function setOffset($start , $offset);

    /**
     * set up sort criteria
     * as ['name' => 'desc' , 'age' => 'asc']
     *
     * @param array $sortCriteria
     * @return $this
     */
    public function sort(array $sortCriteria);

}