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
 * Description of LimitableTrait
 *
 * @author christophe
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
     * @see \oat\taoSearch\model\search\LimitableInterface::getOffset
     */
    public function getOffset() {
        return $this->offset;
    }
    
    /**
     * @see \oat\taoSearch\model\search\LimitableInterface::getLimit
     */
    public function getLimit() {
        return $this->limit;
    }
    
    /**
     * @see \oat\taoSearch\model\search\LimitableInterface::setOffset
     */
    public function setOffset($limit, $offset = null) {
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }
    
}
