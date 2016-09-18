<?php

namespace App\Libraries\Calculator\Exceptions;

use Exception;


/**
 * Class CalculateException extends Exception
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
abstract class CalculateException extends Exception
{

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}