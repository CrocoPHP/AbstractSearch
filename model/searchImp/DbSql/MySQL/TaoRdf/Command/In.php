<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp\DbSql\MySQL\TaoRdf\Command;

/**
 * Description of In
 *
 * @author christophe
 */
class In extends AbstractRdfOperator {
    
    protected $operator = 'IN';


    public function convert(QueryParamInterface $query) {
        if(!is_array($query->getValue())) {
            throw new QueryParsingException('Only array value is only supported by IN operator');
        }
        return '' .$this->setPropertyName($query->getName()) . ' (object ' . $this->operator . ' ("' . implode('" , "', $query->getValue()). '"))';
    }
    
}
