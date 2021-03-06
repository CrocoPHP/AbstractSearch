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

namespace oat\taoSearch\model\search\UsableTrait;

/**
 * use with LimitableInterface
 *
 * @author Christophe GARCIA <christopheg@taotesting.com>
 */
trait LimitableTrait {
    /**
     * number of result
     * @var int
     */
    protected $limit;
    /**
     * start offset
     * @var int
     */
    protected $offset;
    
    /**
     * return offest
     * @see \oat\taoSearch\model\search\LimitableInterface::getOffset
     * @return integer
     */
    public function getOffset() {
        return $this->offset;
    }
    
    /**
     * return limit 
     * @see \oat\taoSearch\model\search\LimitableInterface::getLimit
     * @return integer
     */
    public function getLimit() {
        return $this->limit;
    }
    
    /**
     * set limit and offset
     * @see \oat\taoSearch\model\search\LimitableInterface::setOffset
     * @param integer $limit
     * @param integer $offset
     * @return $this
     */
    public function setOffset($limit, $offset = null) {
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }
    
}
