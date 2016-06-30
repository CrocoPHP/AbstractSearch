<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp;

use \oat\taoSearch\model\search\QueryInterface;

class Query implements QueryInterface {
    
    protected $storedQueryParams = [];
    
    protected $factory;
    
    protected $sort = [];
    
    protected $start;
    
    protected $offset;
    
    protected $queryParamClassName;

    /**
     * @inherit
     */
    public function addOperation($name, $operator, $value, $andSeparator = true) {
    return $this->factory($this->queryParamClassName , [$name, $operator, $value, $andSeparator]);
    }
    /**
     * @inherit
     */
    public function getOffset() {
        return $this->offset;
    }
    /**
     * @inherit
     */
    public function getSort() {
        return $this->sort;
    }
    /**
     * @inherit
     */
    public function getStart() {
        return $this->start;
    }
    /**
     * @inherit
     */
    public function getStoredQueryParams() {
        return $this->storedQueryParams;
    }
    /**
     * @inherit
     */
    public function setOffset($start, $offset) {
        $this->start = $start;
        $this->offset = $offset;
        return $this;
    }
    /**
     * @inherit
     */
    public function setQueryParamClassName($queryParamsClassName) {
        $this->queryParamClassName = $queryParamsClassName;
        return $this;
    }
    /**
     * @inherit
     */
    public function setQueryParamFactory(callable $factory) {
        $this->factory = $factory;
        return $this;
    }
    /**
     * @inherit
     */
    public function sort(array $sortCriteria) {
        $this->sort = $sortCriteria;
        return $this;
    }

}
