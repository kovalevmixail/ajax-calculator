<?php

namespace App\Libraries\Calculator\Exceptions;

use App\Libraries\Calculator\Entities;

/**
 * Class IncorrectExpressionCalculateException extends CalculateException
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class IncorrectExpressionCalculateException extends CalculateException
{
    public function __construct() {

        parent::__construct(Entities\ExceptionMessages::INCORRECT_EXPRESSION);
    }
}