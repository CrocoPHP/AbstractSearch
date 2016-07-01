<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp;

use \oat\taoSearch\model\search\QueryBuilderInterface;
use \oat\taoSearch\model\search\UsableTrait\LimitableTrait;
use \oat\taoSearch\model\search\UsableTrait\SortableTrait;

class QueryBuilder implements QueryBuilderInterface {
    
    use SortableTrait;
    use LimitableTrait;
    
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
        $factory = $this->factory;
        $query = $factory($this->queryClassName);
        $this->storedQueries[] = $query;
        return $query;
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
