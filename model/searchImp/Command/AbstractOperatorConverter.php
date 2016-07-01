<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\searchImp\Command;

use \oat\taoSearch\model\search\command\OperatorConverterInterface;

/**
 * Description of AbstractOperatorCommand
 *
 * @author christophe
 */
abstract class AbstractOperatorConverter implements OperatorConverterInterface {
   
    /**
     * @var string 
     */
    protected $operator = '';
    
    /**
     * return preparate string for property you want to search
     * 
     * @param string $name property name
     * @return string
     */
    protected function setPropertyName($name) {
        
    }
    
}
