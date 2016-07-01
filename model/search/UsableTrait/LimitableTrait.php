<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\search\UsableTrait;

/**
 * Description of LimitableTrait
 *
 * @author christophe
 */
trait LimitableTrait {
    /**
     * number of result
     * @var int
     */
    protected $limit;
    /**
     * start offset
     * @var int
     */
    protected $offset;
    
    /**
     * @see \oat\taoSearch\model\search\LimitableInterface::getOffset
     */
    public function getOffset() {
        return $this->offset;
    }
    
    /**
     * @see \oat\taoSearch\model\search\LimitableInterface::getLimit
     */
    public function getLimit() {
        return $this->limit;
    }
    
    /**
     * @see \oat\taoSearch\model\search\LimitableInterface::setOffset
     */
    public function setOffset($limit, $offset = null) {
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }
    
}
