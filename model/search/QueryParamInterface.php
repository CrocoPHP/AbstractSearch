<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 24/06/16
 * Time: 09:03
 */

namespace oat\taoSearch\model\search;

/**
 * Interface QueryParamInterface
 * @package oat\taoSearch\model\search
 */

interface QueryParamInterface {

    /**
     * set object property on which you need to search
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * set value to search
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);

    /**
     * set query operator
     * @param string $operator
     * @return $this
     */
    public function setOperator($operator);
    
    /**
     * set separator with next query.
     * 
     * @param boolean $separator
     * @return $this
     */
    public function setAndSeparator($separator);

    /**
     * set `and` condition.
     * if operator is null parent operator is use
     * use full for array properties
     *
     * for example test.id = [1 , 12 , 50]
     * test.id contain 1 and test.id contain 12
     *
     * @param mixed $value
     * @param null|string $operator
     * @return $this
     */
    public function addAnd($value , $operator = null);

    /**
     * set `or` condition.
     * if operator is null parent operator is use
     * for example : name equal 'christophe' or name begin by 'b'
     *
     * @param mixed $value
     * @param null|string $operator
     * @return $this
     */
    public function addOr($value , $operator = null);

    /**
     * return param name
     * @return string
     */
    public function getName();

    /**
     * return array of possible values
     * @return array
     */
    public function getValue();

    /**
     * return array of possible operators
     * @return mixed
     */
    public function getOperator();
    /**
     * return true for AND and false for OR
     * @return boolean
     */
    public function getSeparator();
    
    /**
     * return an array of QueryParamInterface stored for 'or' condition
     * @return array
     */
    public function getOr();
    
    /**
     * return an array of QueryParamInterface stored for 'and' condition
     * @return array
     */
    public function getAnd();
    
}