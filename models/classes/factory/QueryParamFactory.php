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

namespace oat\taoSearch\model\factory;

/**
 * Description of QueryParamFactory
 *
 * @author christophe
 */
class QueryParamFactory extends FactoryAbstract {
    
    protected $validInterface = 'oat\\taoSearch\\model\\search\\QueryParamInterface';
    /**
     * 
     * @param string $className
     * @param array $options
     * @return \oat\taoSearch\model\factory\QueryParamInterface
     * @throws \InvalidArgumentException
     */
    public function get($className,array $options = array()) {
        
        if($this->isValidClass($className)) {
            $Param = $this->getServiceLocator()->get($className);
            
            $Param->setName($options[0])
            ->setOperator($options[1])
            ->setValue($options[2])
            ->setAndSeparator($options[3]);
            
            return $Param;
        }
        
    }
    
}
