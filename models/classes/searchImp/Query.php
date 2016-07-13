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
 * Copyright (c) 2016 (original work) Open Assessment Technologies SA;
 *               
 * 
 */

namespace oat\taoSearch\model\searchImp;

use oat\taoSearch\model\factory\FactoryAbstract;
use oat\taoSearch\model\factory\QueryParamFactory;
use oat\taoSearch\model\search\QueryInterface;
use oat\taoSearch\model\search\UsableTrait\OptionsTrait;

/**
 * implemented query object
 */
class Query implements QueryInterface {

    use OptionsTrait;
    
    protected $storedQueryParams = [];
    
    protected $factory;
    
    protected $queryParamClassName = '\\oat\\taoSearch\\model\\searchImp\\QueryParam';
    
    public function __construct() {
        $this->factory = new QueryParamFactory;
    }
    
    public function __clone() {
        $this->reset();
    }
    
    /**
     * reset stored query params
     * @return $this
     */
    public function reset() {
        $this->storedQueryParams = [];
        return $this;
    }

        /**
     * @inherit
     */
    public function addOperation($name, $operator, $value, $andSeparator = true) {
        $param = $this->factory->get($this->queryParamClassName , [$name, $operator, $value, $andSeparator]);
        $this->storedQueryParams[] = $param;
        return $param;
    }
    
    /**
     * @inherit
     */
    public function getStoredQueryParams() {
        return $this->storedQueryParams;
    }
    /**
     * @inherit
     */
    public function setQueryParamClassName($queryParamsClassName) {
        $this->queryParamClassName = $queryParamsClassName;
        return $this;
    }
    /**
     * @inherit
     */
    public function setQueryParamFactory(FactoryAbstract $factory) {
        $this->factory = $factory;
        return $this;
    }

}

