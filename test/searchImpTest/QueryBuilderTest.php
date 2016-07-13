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

namespace oat\taoSearch\test\searchImpTest;

use oat\taoSearch\model\searchImp\QueryBuilder;

/**
 * QueryBuilder test
 *
 * @author Christophe GARCIA <christopheg@taotesting.com>
 */
class QueryBuilderTest extends \oat\taoSearch\test\UnitTestHelper {
    
    /**
     *
     * @var QueryBuilder
     */
    protected $instance;
    
    public function setUp() {
        $this->instance = new QueryBuilder;
    }
    
    public function testSetQueryClassName() {
        
        $fixtureClassName = 'stdClass';
        
        $this->assertSame($this->instance, $this->instance->setQueryClassName($fixtureClassName));
        $this->assertSame($fixtureClassName, $this->getInaccessibleProperty($this->instance , 'queryClassName'));
        
    }
    
    public function testSetQueryFactory() {
        
        $Factory = new \oat\taoSearch\model\factory\QueryFactory;
        
        $this->assertSame($this->instance , $this->instance->setQueryFactory($Factory));
        $this->assertSame($Factory , $this->getInaccessibleProperty($this->instance , 'factory'));
        
    }
    
    public function testGetStoredQueries() {
        
        $fixtureStoredQueries = [
            new \oat\taoSearch\model\searchImp\Query(),
            new \oat\taoSearch\model\searchImp\Query(),
            new \oat\taoSearch\model\searchImp\Query(),
            new \oat\taoSearch\model\searchImp\Query(),
        ];
        
        $this->setInaccessibleProperty($this->instance , 'storedQueries', $fixtureStoredQueries);
        $this->assertSame($fixtureStoredQueries, $this->instance->getStoredQueries());
    }
    
    public function testNewQuery() {
        
        $fixtureQueryClass = 'stdClass';
        
        $mockQuery = $this->prophesize('\oat\taoSearch\model\searchImp\Query');
        $mockQuery = $mockQuery->reveal();
        
        $mockFactoryProphecy = $this->prophesize('\oat\taoSearch\model\factory\FactoryInterface');
        $mockFactoryProphecy->get($fixtureQueryClass)->willReturn($mockQuery)->shouldBeCalledTimes(1);
        $mockFactory = $mockFactoryProphecy->reveal();
        
        $this->setInaccessibleProperty($this->instance , 'queryClassName', $fixtureQueryClass);
        $this->setInaccessibleProperty($this->instance , 'factory', $mockFactory);
        
        $this->assertSame($mockQuery , $this->instance->newQuery());
        $this->assertTrue(in_array($mockQuery , $this->getInaccessibleProperty($this->instance , 'storedQueries')));
    }
}
