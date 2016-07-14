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

namespace oat\taoSearch\model\search\Query;

/**
 * use for Driver sensitive classes
 * usefull for QueryParser
 *
 * @author christophe
 */
interface DriverSensitiveInterface {
    
    /**
     * set up a driver escaper
     * @param \oat\taoSearch\model\search\Query\EscaperInterface $escaper
     * @return $this
     */
    public function setDriverEscaper(EscaperInterface $escaper); 
    
    /**
     * return escaper
     * @return \oat\taoSearch\model\search\Query\EscaperInterface $escaper
     */
    public function getDriverEscaper();
    
}
