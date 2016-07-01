<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp;

use \oat\taoSearch\model\search\QueryParserInterface;
use \oat\taoSearch\model\search\QueryParserCacheInterface;
use \oat\taoSearch\model\search\QueryBuilderInterface;
use \oat\taoSearch\model\search\QueryInterface;
use oat\taoSearch\model\search\QueryParamInterface;
use \oat\taoSearch\model\search\exception\QueryParsingException;
/**
 * @author christophe GARCIA
 */
abstract class AbstractQueryParser implements QueryParserInterface {
    
    protected $cache = false;

    protected $cacheStorage;
    
    protected $query;
    /**
     * @var QueryBuilderInterface 
     */
    protected $criteriaList;
    
    protected $supportedOperators = [];
    
    protected $nextSeparator;
    
    protected $queryPrefix;
    
    protected $operatorNameSpace;
    
    protected $options = [];


    public function disableCache() {
        $this->cache = false;
        return $this;
    }

    public function enableCache() {
        $this->cache = true;
        return $this;
    }

    public function setCacheStorage(QueryParserCacheInterface $cache) {
        $this->cacheStorage = $cache;
        return $this;
    }

    public function setCriteriaList(QueryBuilderInterface $criteriaList) {
        $this->criteriaList = $criteriaList;
        return $this;
    }

    public function parse() {
        
        $this->query = $this->queryPrefix;
        
        foreach ($this->criteriaList->getStoredQueries() as $query) {
            $this->parseQuery($query);
        }
        
        $this->finishQuery();
        return $this->query;
    }
    
    protected function parseQuery(QueryInterface $query) {
        foreach ($query->getStoredQueryParams() as $operation) {
            $this->parseOperation($operation);
        }
    }

    /**
     * @param QueryParamInterface $operation
     */
    protected function parseOperation(QueryParamInterface $operation) {
        
        $value = $operation->getValue();
        
        if(is_a($value, '\\oat\\taoSearch\\model\\search\\QueryBuilderInterface')) {
            $me = (get_class($this));
            /**
             * @var self $parser
             */
            $parser = new $me();
            $value = $parser->setCriteriaList($value)->parse();
            $operation->setValue($value);
        } else if(is_a($value, '\\oat\\taoSearch\\model\\search\\QueryInterface')) {
            $value = $this->parseQuery($value);
            $operation->setValue($value);
        }
        
        $this->setNextSeparator($operation->getSeparator());
        
        $this->prepareOperator();
        $command = $this->getOperator($operation->getOperator())->convert($operation);
        
        $command = $this->setConditions($command , $operation->getAnd(), 'and');
        $command = $this->setConditions($command , $operation->getOr(), 'or');
        
        $this->addOperator($command);
        
        return $this;
        
    }
    /**
     * @inherit
     */
    protected function setConditions(&$command , array $conditionList , $separator = 'and') {
        foreach($conditionList as $condition) {
            
            $addCondition = $this->getOperator($condition->getOperator())->convert($condition);
            $this->mergeCondition($command , $addCondition , $separator);
            
        }
        return $command;
    }

        /**
     * @return \oat\taoSearch\model\search\command\OperatorConverterInterface
     */
    protected function getOperator($operator) {
         
        if(array_key_exists($operator, $this->supportedOperators)) {
            
            $operatorClass = $this->operatorNameSpace . '\\' . ($this->supportedOperators[$operator]);
            return new $operatorClass();
        }
        throw new QueryParsingException('this driver doesn\'t support ' . $operator . ' operator');
    }
    
    /**
     *  @param boolean $and
     */
    protected function setNextSeparator($and) {
        if(!is_null($this->nextSeparator)) {
            
            $this->addSeparator($this->nextSeparator);
        }
        $this->nextSeparator = $and;
    }
    
    /**
     * change your merge process
     * merge array, concat string, fetch object .....
     * 
     * @param mixed $command main query 
     * @param mixed $condition condition to merger
     * @return $this;
     */
    abstract protected function mergeCondition(&$command , $condition, $separator = null);
    
    /**
     * @param array $options
     * @return $this;
     */
    abstract public  function prefixQuery(array $options);
    
    /**
     * @return $this;
     */
    abstract protected  function prepareOperator();
    
    /**
     * @param string $expression
     * @return $this;
     */
    abstract protected  function addOperator($expression);
    
     /**
      *  @param boolean $and
      * @return $this
     */
    abstract protected function addSeparator($and);
    /**
     * parse limitable queries
     */
    abstract protected function addLimit($limit, $offset = null);
    
    /**
     * parse sort criteria
     */
    abstract protected function addSort(array $sort);
    
    abstract protected function finishQuery();
    
}
