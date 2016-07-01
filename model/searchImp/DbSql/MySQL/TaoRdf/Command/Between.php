<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp\DbSql\MySQL\TaoRdf\Command;

use \oat\taoSearch\model\search\QueryParamInterface;
use \oat\taoSearch\model\search\exception\QueryParsingException;
/**
 * Description of LikeContain
 *
 * @author christophe
 */
class Between extends AbstractRdfOperator {
    
    protected $operator = 'BETWEEN';

    public function convert(QueryParamInterface $query) {
        if(!is_array($query->getValue())) {
            throw new QueryParsingException('Only array value is only supported by BETWEEN');
        }
        return '' .$this->setPropertyName($query->getName()) . ' (object ' . $this->operator . ' "' . implode('" AND "', $query->getValue()). '")';
    }
    
}
