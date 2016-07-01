<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp\DbSql\MySQL\TaoRdf;

use \oat\taoSearch\model\searchImp\DbSql\AbstractSqlQueryParser;
use \oat\taoSearch\model\search\helper\SupportedOperatorHelper;
/**
 * Description of QueryParser
 *
 * @author christophe
 */
class QueryParser extends AbstractSqlQueryParser{
    /**
     * @inherit
     */
     protected $operatorNameSpace = '\\oat\\taoSearch\\model\\searchImp\\DbSql\\MySQL\\TaoRdf\\Command';
     /**
     * @inherit
     */
     protected $supportedOperators = 
             [
                 SupportedOperatorHelper::EQUAL              => 'Equal',
                 SupportedOperatorHelper::GREATER_THAN       => 'GreaterThan',
                 SupportedOperatorHelper::LESSER_THAN        => 'LesserThan',
                 SupportedOperatorHelper::GREATER_THAN_EQUAL => 'GreaterThanOrEqual',
                 SupportedOperatorHelper::LESSER_THAN_EQUAL  => 'LesserThanOrEqual',
                 SupportedOperatorHelper::CONTAIN            => 'LikeContain',
                 SupportedOperatorHelper::MATCH              => 'Like',
                 SupportedOperatorHelper::IN                 => 'In',
                 SupportedOperatorHelper::BETWEEN            => 'Between',
                 SupportedOperatorHelper::BEGIN_BY           => 'LikeBegin',
             ];
    
    public function prefixQuery(array $options)
    {
        if($this->validateOptions($options)) {
            $fields = '*';

            if(array_key_exists('fields' , $options)) {
               $fields = '`' . implode('`,`' , $options['fields']) . '`';
            }

            $this->queryPrefix = 'select ' . $fields . ' from statements '
                    . 'WHERE subject IN ( '
                    . 'SELECT subject from ('
                    . 'SELECT DISTINCT(subject) FROM statements WHERE ';
        }
        $this->options = $options;
        return $this;

    } 
     
    /**
     * specific tao
     * @var string
     */
    protected $limitString;
     
    /**
     * @inherit
     */
    public function prepareOperator()
    {
        $this->query .= "\n";
    }
    /**
     * @inherit
     */
    public function addOperator($expression)
    {
       $this->query .= '( subject IN ((SELECT DISTINCT subject FROM ' . $this->options['table'] . ' WHERE ' . $expression . ')))';
       return $this;
    }
    /**
     * @inherit
     */
    protected function mergeCondition(&$command , $condition, $separator = null) {
        $command .= ' ' . strtoupper($separator) . ' ' . $condition . ' ';
    }
    
    protected function finishQuery() {
        $this->query .= '' . $this->addLimit($this->criteriaList->getLimit() , $this->criteriaList->getOffset()) .' ) as subQuery ) '. $this->addSort($this->criteriaList->getSort());
        $this->query .=     " \n";
    }
    
}
