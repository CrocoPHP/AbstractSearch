<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 30/06/16
 * Time: 17:50
 */

namespace oat\taoSearch\model\searchImp\DbSql;

use oat\taoSearch\model\search\exception\QueryParsingException;
use \oat\taoSearch\model\searchImp\AbstractQueryParser;

abstract class AbstractSqlQueryParser extends AbstractQueryParser {

    
    public function prefixQuery(array $options)
    {
        if($this->validateOptions($options)) {
            $fields = '*';
            $this->queryPrefix = 'SELECT ';

            if(array_key_exists('fields' , $options)) {
               $fields = '`' . implode('`,`' , $options['fields']) . '`';
            }

            $this->queryPrefix .= $fields . ' FROM '  . $options['table'] . ' WHERE ';
        }
        $this->options = $options;
        return $this;

    }
    /**
     * @inherit
     */
    protected function validateOptions(array $options) {

        if(!array_key_exists('table' , $options)) {
            throw new QueryParsingException('table option is mandatory');
        }
        return true;

    }
    /**
     * @inherit
     */
    protected function prepareOperator()
    {
        $this->query .= '';
    }
    /**
     * @inherit
     */
    protected function addOperator($expression)
    {
       $this->query .= ' ' . $expression;
        return $this;
    }
    /**
     * @inherit
     */
    protected function addSeparator($and)
    {
       $separator = 'OR';

        if($and) {
            $separator = 'AND';
        }
        $this->query .= ' ' . $separator . ' ';
        return $this;
    }
    /**
     * @inherit
     */
    protected function addLimit($limit, $offset = null) {
        $limitQuery = '';
        
        if($limit > 0) {
            $limitQuery .= 'LIMIT '. $limit;
            if(!is_null($offset)) {
                $limitQuery .= ' OFFSET ' . $offset;
            }
        }
        
        return $limitQuery;
    }
    /**
     * @inherit
     */
    protected function addSort(array $sortCriteria) {
        $sort = '';
        
        $orderOperator = [
            'asc'  => 'ASC',
            'desc' => 'DESC',
        ];
        
        if(count($sortCriteria) > 0) {
            $sort = ' ORDER BY ';
            $crirerias = [];
            foreach ($sortCriteria as $field => $order) {
                $crirerias[] = ' ' . $field . ' ' . $orderOperator[$order] . ' ';
            }
            $sort .= implode(',' , $crirerias);
        }
        
        return $sort;
    }
    
    protected function finishQuery() {
        $this->query .= $this->addSort($this->criteriaList->getSort()) .  ' ' . $this->addLimit($this->criteriaList->getLimit() , $this->criteriaList->getOffset()) .  " \n";
    }


}