<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 24/06/16
 * Time: 10:15
 */

namespace oat\taoSearch\model\search;

interface ResultSetInterface extends \Iterator, \Countable
{

    /**
     * return total number of result
     * @return integer
     */
    public function total();

}