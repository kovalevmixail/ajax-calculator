<?php

namespace App\Libraries\Calculator\Exceptions;

use App\Libraries\Calculator\Entities;

/**
 * Class NotNumericArgumentCalculateException extends CalculateException
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class NotNumericArgumentCalculateException extends CalculateException
{
    public function __construct($value) {

        $message = sprintf(Entities\ExceptionMessages::NOT_NUMERIC_ARGUMENTS, $value + 1);
        parent::__construct($message);
    }
}