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
namespace oat\taoSearch\model\searchImp\DbSql\TaoRdf\Command;

use \oat\taoSearch\model\searchImp\Command\AbstractOperatorConverter;
use \oat\taoSearch\model\search\QueryParamInterface;

/**
 * Description of AbstractRdfOperator
 *
 * @author christophe
 */
class AbstractRdfOperator extends AbstractOperatorConverter {
    
    /**
     * return formated operator
     * @return string
     */
    protected function getOperator() {
        return $this->getDriverEscaper()->dbCommand($this->operator);
    }

        /**
     * @inherit
     */
    protected function setPropertyName($name) {
        if(!empty($name)) {
            $name = $this->getDriverEscaper()->escape($name);
            $name = $this->getDriverEscaper()->quote($name);
            return '(' . $this->getDriverEscaper()->reserved('predicate') . ' = ' . $name . ') ' 
                    . $this->getDriverEscaper()->dbCommand('AND');
        }
        return '';
    }
    /**
     * @inherit
     */
    public function convert(QueryParamInterface $query) {
        $value = $this->getDriverEscaper()->escape($query->getValue());
        $value = $this->getDriverEscaper()->quote($value);
        return '' . $this->setPropertyName($query->getName()) . ' ' . $this->getDriverEscaper()->reserved('object') . ' ' . $this->getOperator() . ' ' . $value;
    }
    
}
