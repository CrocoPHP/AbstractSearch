<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\factoryTest;

/**
 * Description of FactoryAbstractTest
 *
 * @author christophe
 */
class FactoryAbstractTest extends \oat\taoSearch\test\UnitTestHelper
{
    
    protected $instance;


    public function setUp() {
        
        $this->instance = $this->getMockForAbstractClass('oat\taoSearch\model\factory\FactoryAbstract');
        
    }
    
    public function isValidClassProvide() {
        
        return [
            ['\\oat\\taoSearch\\model\\searchImp\\QueryParam' , true  , false],
            ['\\oat\\taoSearch\\model\\searchImp\\Query'      , null , true ]
        ];
        
    }
    
    /**
     * 
     * @param type $class
     * @param type $return
     * @param type $exception
     * @dataProvider isValidClassProvide
     */
    public function testIsValidClass($class, $return, $exception) {
        
        if($exception) {
            $this->setExpectedException('\InvalidArgumentException');
        } 
        
        $valid = new \ReflectionProperty($this->instance,'validInterface');
        $valid->setAccessible(true);
        $valid->setValue($this->instance, 'oat\\taoSearch\\model\\search\\QueryParamInterface');
        $reflexion = new \ReflectionMethod($this->instance,'isValidClass');
        $reflexion->setAccessible(true);
        
        $class = new $class();
        
        $this->assertSame($return, $reflexion->invokeArgs($this->instance , [$class]));
        
    }
    
}
