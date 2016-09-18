<?php

namespace App\Libraries\Calculator\Exceptions;

use App\Libraries\Calculator\Entities;

/**
 * Class NullValueCalculateException extends CalculateException
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class NullValueCalculateException extends CalculateException
{
    public function __construct($value) {

        $message = sprintf(Entities\ExceptionMessages::NULL_VALUE, $value + 1);
        parent::__construct($message);
    }
}