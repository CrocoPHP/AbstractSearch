<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\search;

/**
 * interface for limitable queries
 *
 * @author christophe GARCIA
 */
interface LimitableInterface {
    
    /**
     * set query limit
     *
     * @param int $limit
     * @param int|null $offset
     * @return $this
     */
    public function setOffset($limit , $offset = null);
    
    /**
     * return start item
     * @return int
     */
    public function getLimit();
    
    /**
     * return query offest
     * @return int
     */
    public function getOffset();
    
}
