<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 24/06/16
 * Time: 11:47
 */

namespace oat\taoSearch\model\search\helper;

/**
 * Class SupportedOperatorHelper
 *
 * define constant for each supported operator.
 *
 * @package oat\taoSearch\model\search\helper
 */
class SupportedOperatorHelper {

    const EQUAL = 'equal';

    const DIFFERENT = 'notequal';

    const GREATER_THAN = 'gt';

    const GREATER_THAN_EQUAL = 'gte';

    const LESSER_THAN = 'lt';

    const LESSER_THAN_EQUAL = 'lte';

    const BETWEEN = 'between';

    const IN      = 'in';

    const MATCH   = 'match';

    CONST CONTAIN = 'contain';

}