<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\factoryTest;

/**
 * Description of QueryFactory
 *
 * @author christophe
 */
class QueryFactoryTest extends \oat\taoSearch\test\UnitTestHelper 
{
    
    protected $instance;
    
    public function setup() {
        
    $this->instance = $this->getMock('\\oat\\taoSearch\\model\\factory\\QueryFactory', ['isValidClass']);
        
    }
    
    public function testInvokeFactory() {
        
         $fixtureOptions = [
            'test',
            'equal',
            'toto', 
            false
        ];
        $testClassName  = '\\oat\\taoSearch\\model\\search\\QueryInterface';
        $mockTest       = $this->getMock('\\stdClass' , ['setOptions']);
        
        $mockTest->expects($this->once())
                ->method('setOptions')
                ->with($fixtureOptions)
                ->willReturn($mockTest);
        
        
        $serviceManager =  $this->getMock('\\Zend\\ServiceManager\\ServiceManager');
        
        $serviceManager->expects($this->once())
                ->method('get')
                ->with($testClassName)
                ->willReturn($mockTest);
        
        $valid = new \ReflectionProperty($this->instance , 'serviceLocator');
        $valid->setAccessible(true);
        $valid->setValue($this->instance, $serviceManager);
        
        $this->instance->expects($this->once())->method('isValidClass')->with($testClassName)->willReturn(true);
        $this->assertEquals($mockTest , $this->instance->get($testClassName , $fixtureOptions));
    }
    
}
