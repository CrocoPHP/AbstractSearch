<?php

/*
 * This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License
 *  as published by the Free Software Foundation; under version 2
 *  of the License (non-upgradable).
 *  
 * This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 * 
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 *  Copyright (c) 2016 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 */

namespace oat\taoSearch\model\searchImp;

use oat\taoSearch\model\search\SearchGateWayInterface;
use oat\taoSearch\model\search\UsableTrait\DriverSensitiveTrait;
use oat\taoSearch\model\search\UsableTrait\OptionsTrait;
use \Zend\ServiceManager\ServiceLocatorAwareTrait;
/**
 * AbstractSearchGateWay
 *
 * @author Christophe GARCIA <christopheg@taotesting.com>
 */
abstract class AbstractSearchGateWay implements SearchGateWayInterface
{
    use ServiceLocatorAwareTrait;
    use OptionsTrait;
    use DriverSensitiveTrait;
    
    /**
     * parser service or className
     * @var string 
     */
    protected $parserList = [
        'taoRdf' => 'search.tao.parser'
    ];
    
    protected $driverList = [
        'taoRdf' => 'search.driver.mysql'
    ];
    
    protected $builderClassName = 'search.query.builder';


    /**
     * resultSet service or className
     * @var string 
     */
    protected $resultSetClassName;
    /**
     * global driver name
     * @var string 
     */
    protected $driverName;
    /**
     * database connector
     * @var mixed 
     */
    protected $connector;
    
    /**
     * @inheritDoc
     */
    public function init() {
        $options = $this->getServiceLocator()->get('search.options');
        $this->setOptions($options);
        $this->driverName = $options['driver'];
        $this->setDriverEscaper($this->getServiceLocator()->get($this->driverList[$this->driverName]));
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getDriverName() {
        return $this->driverName;
    }

    /**
     * @inheritDoc
     */
    public function setConnector($connector) {
        $this->connector = $connector;
        return $this;
    }
    /**
     * @inheritDoc
     */
    public function getConnector() {
        return $this->connector;
    }
    
    /**
     * @inheritDoc
     */
    public function setResultSetClassName($resultSetClassName) {
        $this->resultSetClassName = $resultSetClassName;
        return $this;
    }
    /**
     * @inheritDoc
     * @return \oat\taoSearch\model\search\QueryParserInterface
     */
    public function getParser() {
       $parser = $this->getServiceLocator()->get($this->parserList[$this->driverName]);
       $parser->setServiceLocator($this->serviceLocator)->setDriverEscaper($this->driverEscaper)->setOptions($this->options)->prefixQuery();
       return $parser;
    }

     /**
     * @inherit
     */
    public function getResultSetClassName() {
        return $this->resultSetClassName;
    }
    
    /**
     * @inherit
     */
    public function query() {
        $builder = $this->getServiceLocator()->get($this->builderClassName);
        $builder->setOptions($this->options)->setServiceLocator($this->serviceLocator);
        return $builder;
    }
    
    /**
     * @inherit
     */
    public function setBuilderClassName($builderSetClassName) {
        $this->builderClassName = $builderSetClassName;
        return $this;
    }
    
    /**
     * @inherit
     */
    public function getBuilderSetClassName() {
        return $this->builderClassName;
    }
}
