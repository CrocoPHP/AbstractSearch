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

    protected $report;

    public function prefixQuery(array $options)
    {
        if($this->validateOptions($options)) {
            $fields = '*';
            $this->queryPrefix = 'select ';

            if(array_key_exists('fields' , $options)) {
               $fields = '`' . implode('`,`' , $options['fields']) . '`';
            }

            $this->queryPrefix .= $fields . ' FROM '  . $options['table'] . 'WHERE';
        }
        return $this;

    }

    protected function validateOptions(array $options) {

        if(!array_key_exists('table' , $options)) {
            throw new QueryParsingException('table option is mandatory');
        }
        return true;

    }

    public function prepareOperator()
    {
        $this->query .= '';
    }

    public function addOperator($expresssion)
    {
       $this->query .= ' ' . $expresssion;
        return $this;
    }

    function addSeparator($and)
    {
       $separator = 'OR';

        if($and) {
            $separator = 'AND';
        }
        $this->query .= ' ' . $separator . ' ';
        return $this;
    }


}