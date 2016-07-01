<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace oat\taoSearch\model\search;

/**
 * interface for sortable queries
 *
 * @author christophe
 */
interface SortableInterface {
    
    /**
     * set up sort criteria
     * as ['name' => 'desc' , 'age' => 'asc']
     *
     * @param array $sortCriteria
     * @return $this
     */
    public function sort(array $sortCriteria);
    
    /**
     * return sort criterias
     * @return array
     */
    public function getSort();
    
}
