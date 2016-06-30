<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp;

use \oat\taoSearch\model\search\QueryParamInterface;

class QueryParam implements QueryParamInterface {
    
    protected $name;
    
    protected $operator;
    
    protected $value;
    
    protected $separator;
    
    protected $and = [];
    
    protected $or = [];

    public function addAnd($name, $operator, $value) {
        
        $param = new self();
        $param->setName($name)->setOperator($operator)->setValue($value);
        $this->and[] = $param;
        return $this;
    }

    public function addOr($name, $operator, $value) {
        
        $param = new self();
        $param->setName($name)->setOperator($operator)->setValue($value);
        $this->or[] = $param;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function getOperator() {
        return $this->operator;
    }

    public function getValue() {
        return $this->value;
    }
    
    public function getSeparator() {
        return $this->separator;
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setOperator($operator) {
        $this->operator = $operator;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
    }
    
    public function setAndSeparator($separator) {
        $this->separator = $separator;
    }

}