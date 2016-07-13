<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\factoryTest;

/**
 * Description of QueryBuilderFactoryTest
 *
 * @author christophe
 */
class QueryBuilderFactoryTest extends \oat\taoSearch\test\UnitTestHelper 
{
    
    protected $instance;
    
    public function setup() {
        $this->instance = $this->getMock('\\oat\\taoSearch\\model\\factory\\QueryBuilderFactory', ['isValidClass' , 'getServiceLocator']);
    }
    
    public function testInvokeFactory() {
        
        $fixtureOptions = [
            'test',
            'equal',
            'toto', 
            false
        ];
        $testClassName  = '\\oat\\taoSearch\\model\\search\\QueryBuilderInterface';
        $mockTest       = $this->getMock('\\oat\\taoSearch\\model\\searchImp\\QueryBuilder' , ['setOptions']);
        
        $mockTest->expects($this->once())
                ->method('setOptions')
                ->with($fixtureOptions)
                ->willReturn($mockTest);
        
        
        $serviceManager =  $this->getMock('\\Zend\\ServiceManager\\ServiceManager');
        
        $serviceManager->expects($this->once())
                ->method('get')
                ->with($testClassName)
                ->willReturn($mockTest);
        
        $this->instance->expects($this->once())->method('isValidClass')->with($testClassName)->willReturn(true);
        $this->instance->expects($this->once())->method('getServiceLocator')->willReturn($serviceManager);
        $this->assertEquals($mockTest , $this->instance->get($testClassName , $fixtureOptions));
    }
    
}
