<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\search;

/**
 * create query
 */
interface QueryInterface {
    
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
    
    /**
     * return sort criterias
     * @return array
     */
    public function getSort();
    
    /**
     * return start item
     * @return int
     */
    public function getStart();
    
    /**
     * return query offest
     * @return int
     */
    public function getOffset();
    
    /**
     * return all query params object stored
     * @return array
     */
    public function getStoredQueryParams();
}

