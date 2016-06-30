<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 24/06/16
 * Time: 10:39
 */

namespace oat\taoSearch\model\search;
use oat\taoSearch\model\search\exception\SearchGateWayExeption;

/**
 * Interface SearchGateWayInterface
 *
 * use to manage connection to database system
 *
 * @package oat\taoSearch\model\search
 */
interface SearchGateWayInterface
{
    /**
     * return connection options
     * @return array
     */
    public function getOptions();

    /**
     * set up connection option
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options);
    
    /**
     * set up database connector if needed
     * @param mixed connector
     * @return $this
     */
    public function setConnector($connector);
    
    /**
     * return database connector
     * @return mixed
     */
    public function getConnector();

        /**
     * try to connect to database. throw an exception
     * if connection failed.
     *
     * @throws SearchGateWayExeption
     * @return $this
     */
    public function connect();

    /**
     * send a searchQuery and return a resultSetOnSuccess
     * throws a exception on failure
     *
     * @throws SearchGateWayExeption
     * @param $query
     * @return ResultSetInterface
     */
    public function select($query);

    /**
     * update operation. true on success
     * false on failure.
     *
     * throw an exception if an error occured
     *
     * @throws SearchGateWayExeption
     * @param array $object
     * @return boolean
     */
    public function update($object);

    /**
     * insert operation. true on success
     * false on failure.
     *
     * throw an exception if an error occured
     *
     * @throws SearchGateWayExeption
     * @param array $object
     * @return boolean
     */
    public function insert($object);

    /**
     * delete operation. true on success
     * false on failure.
     *
     * throw an exception if an error occured
     *
     * @throws SearchGateWayExeption
     * @param mixed $id
     * @return boolean
     */
    public function delete($id);

}