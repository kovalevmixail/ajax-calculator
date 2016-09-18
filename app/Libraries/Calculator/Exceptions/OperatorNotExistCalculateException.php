<?php

namespace App\Libraries\Calculator\Exceptions;

use App\Libraries\Calculator\Entities;

/**
 * Class OperatorNotExistCalculateException extends CalculateException
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class OperatorNotExistCalculateException extends CalculateException
{
    public function __construct($className) {

        $message = sprintf(Entities\ExceptionMessages::OPERATOR_NOT_EXIST, $className);
        parent::__construct($message);
    }
}