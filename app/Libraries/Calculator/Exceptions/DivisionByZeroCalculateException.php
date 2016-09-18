<?php

namespace App\Libraries\Calculator\Exceptions;

use App\Libraries\Calculator\Entities;

/**
 * Class DivisionByZeroCalculateException extends CalculateException
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class DivisionByZeroCalculateException extends CalculateException
{
    public function __construct($message = Entities\ExceptionMessages::DIVISION_BY_ZERO, $code = 0) {

        parent::__construct($message, $code);
    }
}