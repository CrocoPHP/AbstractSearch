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

use oat\taoSearch\model\factory\FactoryAbstract;
use oat\taoSearch\model\factory\QueryFactory;
use oat\taoSearch\model\search\QueryBuilderInterface;
use oat\taoSearch\model\search\UsableTrait\LimitableTrait;
use oat\taoSearch\model\search\UsableTrait\SortableTrait;
use oat\taoSearch\model\search\UsableTrait\OptionsTrait;

class QueryBuilder implements QueryBuilderInterface {
    
    use SortableTrait;
    use LimitableTrait;
    use OptionsTrait;
    
    /**
     * @var array
     */
    protected $storedQueries = [];
    /**
     * @var callable 
     */
    protected $factory;
    /**
     * @var string
     */
    protected $queryClassName = '\\oat\\taoSearch\\model\\searchImp\\Query';
    /**
     * @inherit
     */
    
    public function __construct() {
        $this->factory = new QueryFactory;
    }


    public function getStoredQueries() {
        return $this->storedQueries;
    }
    
    /**
     * @inherit
     */
    public function newQuery() {
        $factory = $this->factory;
        $query = $factory->get($this->queryClassName);
        $this->storedQueries[] = $query;
        return $query;
    }
    
    /**
     * @inherit
     */
    public function setQueryClassName($queryClassName) {
        $this->queryClassName = $queryClassName;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function setQueryFactory(FactoryAbstract $factory) {
        $this->factory = $factory;
        return $this;
    }

}
