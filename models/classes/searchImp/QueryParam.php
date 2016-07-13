<?php
/**  
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 * Copyright (c) 2016 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *               
 * 
 */

namespace oat\taoSearch\model\searchImp;

use \oat\taoSearch\model\search\QueryParamInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class QueryParam implements QueryParamInterface,ServiceLocatorAwareInterface {
    
    use ServiceLocatorAwareTrait;
    
    protected $name;
    
    protected $operator;
    
    protected $value;
    
    protected $separator;
    
    protected $and = [];
    
    protected $or = [];
    
    /**
     * @inherit
     */
    protected function setDefaultOperator($operator) {
        if(is_null($operator)) {
            $operator = $this->getOperator();
        }
        return $operator;
    }

    /**
     * @inherit
     */
    public function addAnd($value , $operator = null) {
        
        $param = new self();
        $param->setOperator($this->setDefaultOperator($operator))->setValue($value);
        $this->and[] = $param;
        return $this;
    }
    /**
     * @inherit
     */
    public function addOr($value , $operator = null) {
        
        $param = new self();
        $param->setOperator($this->setDefaultOperator($operator))->setValue($value);
        $this->or[] = $param;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * @inherit
     */
    public function getOperator() {
        return $this->operator;
    }
    
    /**
     * @inherit
     */
    public function getValue() {
        return $this->value;
    }
    
    /**
     * @inherit
     */
    public function getSeparator() {
        return $this->separator;
    }
    
    /**
     * @inherit
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function setOperator($operator) {
        $this->operator = $operator;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function setAndSeparator($separator) {
        $this->separator = $separator;
        return $this;
    }
    /**
     * @inherit
     */
    public function getAnd() {
       return $this->and; 
    }
    /**
     * @inherit
     */
    public function getOr() {
       return $this->or;
    }


}