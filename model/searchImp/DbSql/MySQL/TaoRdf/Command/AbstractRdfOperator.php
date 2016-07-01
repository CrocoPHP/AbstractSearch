<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp\DbSql\MySQL\TaoRdf\Command;

use \oat\taoSearch\model\searchImp\Command\AbstractOperatorConverter;
use \oat\taoSearch\model\search\QueryParamInterface;

/**
 * Description of AbstractRdfOperator
 *
 * @author christophe
 */
class AbstractRdfOperator extends AbstractOperatorConverter {
    
    /**
     * @inherit
     */
    protected function setPropertyName($name) {
        if(!empty($name)) {
            return '(predicate = "' . $name. '") AND';
        }
        return '';
    }
    /**
     * @inherit
     */
    public function convert(QueryParamInterface $query) {
        return '' . $this->setPropertyName($query->getName()) . ' object ' . $this->operator . ' "' . $query->getValue(). '"';
    }
    
}
