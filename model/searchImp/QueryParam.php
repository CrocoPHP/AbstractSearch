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
    
    /**
     * @inherit
     */
    protected function setDefaultOperator($operator) {
        if(is_null($operator)) {
            $operator = $this->getOperator();
        }
        return $operator;
    }

    /**
     * @inherit
     */
    public function addAnd($value , $operator = null) {
        
        $param = new self();
        $param->setOperator($this->setDefaultOperator($operator))->setValue($value);
        $this->and[] = $param;
        return $this;
    }
    /**
     * @inherit
     */
    public function addOr($value , $operator = null) {
        
        $param = new self();
        $param->setOperator($this->setDefaultOperator($operator))->setValue($value);
        $this->or[] = $param;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * @inherit
     */
    public function getOperator() {
        return $this->operator;
    }
    
    /**
     * @inherit
     */
    public function getValue() {
        return $this->value;
    }
    
    /**
     * @inherit
     */
    public function getSeparator() {
        return $this->separator;
    }
    
    /**
     * @inherit
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function setOperator($operator) {
        $this->operator = $operator;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function setValue($value) {
        $this->value = $value;
    }
    
    /**
     * @inherit
     */
    public function setAndSeparator($separator) {
        $this->separator = $separator;
    }
    /**
     * @inherit
     */
    public function getAnd() {
       return $this->and; 
    }
    /**
     * @inherit
     */
    public function getOr() {
       return $this->or;
    }


}