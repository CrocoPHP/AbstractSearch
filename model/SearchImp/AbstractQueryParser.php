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
    
    protected $criteriaList;
    
    protected $supportedOperators = [];
    
    protected $nextSeparator;
    
    protected $queryPrefix;
    
    protected $operatorNameSpace;

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
    }

    public function parse() {
        
        foreach ($this->criteriaList as $query) {
            $this->parseQuery($query);
        }
        
        return $this->query;
    }
    
    protected function parseQuery(QueryInterface $query) {
        foreach ($query as $operation) {
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
        $this->addOperator($this->getOperator($operation->getOperator())->convert($operation));
        
    }
    /**
     * @return \oat\taoSearch\model\search\command\OperatorConverterInterface
     */
    protected function getOperator($operator) {
         
        if(array_key_exists($operator, $this->supportedOperators)) {
            $this->prepareOperator();
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
     * @param array $options
     * @return $this;
     */
    abstract public function prefixQuery(array $options);
    
    /**
     * @return $this;
     */
    abstract public function prepareOperator();
    
    /**
     * @param string $expression
     * @return $this;
     */
    abstract public function addOperator($expression);
    
     /**
      *  @param boolean $and
      * @return $this
     */
    abstract function addSeparator($and);
}
