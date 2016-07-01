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
    
    protected $queryParamClassName = 'oat\\taoSearch\\model\\searchImp\\QueryParam';
    
    public function __construct() {
        $this->factory = function ($className , $arguments) {
            $Param = new $className();
            $Param->setName($arguments[0]);
            $Param->setOperator($arguments[1]);
            $Param->setValue($arguments[2]);
            $Param->setAndSeparator($arguments[3]);
            
            return $Param;
        };
    }


    /**
     * @inherit
     */
    public function addOperation($name, $operator, $value, $andSeparator = true) {
        $factory = $this->factory;
        $param = $factory($this->queryParamClassName , [$name, $operator, $value, $andSeparator]);
        $this->storedQueryParams[] = $param;
        return $param;
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

}

