<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 24/06/16
 * Time: 09:37
 */

namespace oat\taoSearch\model\search;

use oat\taoSearch\model\search\command\OperatorConverterInterface;
/**
 * Interface QueryParserInterface
 *
 * transform QueryBuilder criteria to an exploitable query
 * for database system driver
 *
 * @package oat\taoSearch\model\search
 */
interface QueryParserInterface {
    
    /**
     * create query base
     * @param array $options
     * @return $this
     */
    public function prefixQuery(array $options);

        /**
     * transform QueryBuilderInterface to an exploitable criteria list
     *
     * @param QueryBuilderInterface $criteriaList
     * @return $this
     */
    public function setCriteriaList(QueryBuilderInterface $criteriaList);

    /**
     * create query as string, array, or other exploitable by data storage driver.
     * using command design pattern
     *
     * @internal OperatorConverterInterface $converter
     * @return mixed
     */
    public function parse();
    
    /**
     * set up query result cache storage
     * @param QueryParserCacheInterface $cache
     * @return $this
     */
    public function setCacheStorage(QueryParserCacheInterface $cache);
    
    /**
     * enable cache for query transaltion result
     * @return $this
     */
    public function disableCache();
    
    /**
     * disable cache for query transaltion result
     * @return $this
     */
    public function enableCache();

}