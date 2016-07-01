<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\search\UsableTrait;

/**
 * use with sortableInterface
 *
 * @author christophe
 */
trait SortableTrait {
    /**
     * array of sort criterias
     */
    protected $sort = [];

    /**
     * @see \oat\taoSearch\model\search\SortableInterface::getSort
     */
    public function getSort() {
        return $this->sort;
    }
    /**
     * @see \oat\taoSearch\model\search\SortableInterface::sort
     */
    public function sort(array $sortCriteria) {
        $this->sort = $sortCriteria;
        return $this;
    }
    
}
