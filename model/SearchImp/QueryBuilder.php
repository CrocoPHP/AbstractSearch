<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp;

use \oat\taoSearch\model\search\QueryBuilderInterface;

class QueryBuilder implements QueryBuilderInterface {
    /**
     * @var array
     */
    protected $storedQueries = [];
    /**
     * @var callable 
     */
    protected $factory;
    /**
     * @var string
     */
    protected $queryClassName;
    /**
     * @inherit
     */
    public function getStoredQueries() {
        return $this->storedQueries;
    }
    
    /**
     * @inherit
     */
    public function newQuery() {
        return $this->factory($this->queryClassName);
    }
    
    /**
     * @inherit
     */
    public function setQueryClassName($queryClassName) {
        $this->queryClassName = $queryClassName;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function setQueryFactory(callable $factory) {
        $this->factory = $factory;
        return $this;
    }

    
}
