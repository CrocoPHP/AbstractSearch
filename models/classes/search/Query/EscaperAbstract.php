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
 * Description of EscaperAbstract
 *
 * @author christophe
 */
abstract class EscaperAbstract implements EscaperInterface
{
   /**
    * use to quote string value
    * @var string
    */
    protected $escapeStringChar = '';
    /**
     * use to quote database system reserved name
     * @var string
     */
    protected $escapeReserved   = '';
    /**
     * All fields character
     * @var string
     */
    protected $allFieldsAlias = '*';
    /**
     * fields list separator
     * @var string 
     */
    protected $fieldsSeparator = ',';
    /**
     * empty string equivalent
     * @var string 
     */
    protected $empty = '';


    /**
     * @inherit
     */
    public function quote($stringValue) {
        return $this->escapeStringChar . $stringValue . $this->escapeStringChar;
    }
    /**
     * @inherit
     */
    public function reserved($stringValue) {
        return $this->escapeReserved  . $stringValue . $this->escapeReserved ;
    }
    /**
     * @inherit
     */
    public function getAllFields() {
        return $this->allFieldsAlias;
    }
    /**
     * @inherit
     */
    public function getFieldsSeparator() {
        return $this->fieldsSeparator;
    }
    /**
     * @inherit
     */
    public function getQuoteChar() {
        return $this->escapeStringChar;
    }
    /**
     * @inherit
     */
    public function getReservedQuote() {
        return $this->escapeReserved;
    }

    public function getEmpty() {
        return $this->quote($this->empty);
    }
    
}
