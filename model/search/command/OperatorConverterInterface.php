<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 24/06/16
 * Time: 11:28
 */

namespace oat\taoSearch\model\search\command;

use oat\taoSearch\model\search\exception\QueryParsingException;
use oat\taoSearch\model\search\QueryParamInterface;

/**
 * Interface OperatorConverterInterface
 *
 * use for command design pattern on query parsing
 * with a specific operator
 *
 * @package oat\taoSearch\model\search\command
 */
interface OperatorConverterInterface
{
    /**
     * create a part of query exploitable by database driver
     * throw an exception if value data type isn't compatible with operator
     *
     * @throws QueryParsingException
     * @param QueryParamInterface $query
     * @return mixed
     */
    public function convert(QueryParamInterface $query);

}