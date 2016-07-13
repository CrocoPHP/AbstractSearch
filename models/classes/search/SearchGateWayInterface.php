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

namespace oat\taoSearch\model\search;
use oat\taoSearch\model\search\exception\SearchGateWayExeption;

/**
 * Interface SearchGateWayInterface
 *
 * use to manage connection to database system
 *
 * @package oat\taoSearch\model\search
 */
interface SearchGateWayInterface
{
    /**
     * return connection options
     * @return array
     */
    public function getOptions();

    /**
     * set up connection option
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options);
    
    /**
     * set up database connector if needed
     * @param mixed connector
     * @return $this
     */
    public function setConnector($connector);
    
    /**
     * return database connector
     * @return mixed
     */
    public function getConnector();

        /**
     * try to connect to database. throw an exception
     * if connection failed.
     *
     * @throws SearchGateWayExeption
     * @return $this
     */
    public function connect();

    /**
     * send a searchQuery and return a resultSetOnSuccess
     * throws a exception on failure
     *
     * @throws SearchGateWayExeption
     * @param $query
     * @return ResultSetInterface
     */
    public function search($query);

    /**
     * change default parser factory
     * 
     * @param callable $factory
     * @return $this
     */
    public function setParserFactory(callable $factory);
    
    /**
     * set up a new parser
     * @return QueryParserInterface
     */
    public function getParser();

     /**
      * return GateWay DriverName
     * @return string  
     */
    public function getDriverName();
    
    /**
     * change default resultSet factory
     * 
     * @param callable $factory
     * @return $this
     */
    public function setResultSetFactory(callable $factory);
    
    /**
     * change default resultSet class name
     * 
     * @param string $resultSetClassName
     * @return $this
     */
    public function setResultSetClassName($resultSetClassName);
    
    /**
     * return resultSet class name
     * @return string
     */
    public function getResultSetClassName();
}