<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp\DbSql\MySQL\TaoRdf\Command;

use \oat\taoSearch\model\search\QueryParamInterface;
/**
 * Description of LikeContain
 *
 * @author christophe
 */
class LikeContain extends AbstractRdfOperator {
    
    protected $operator = 'LIKE';


    public function convert(QueryParamInterface $query) {
        return '' .$this->setPropertyName($query->getName()) . ' object ' . $this->operator . ' "%' . $query->getValue(). '%"';
    }
    
}
