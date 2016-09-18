<?php

namespace App\Libraries\Calculator\Exceptions;

use App\Libraries\Calculator\Entities;

/**
 * Class IncorrectArgumentsCountCalculateException extends CalculateException
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class IncorrectArgumentsCountCalculateException extends CalculateException
{
    public function __construct(array $correct_counts) {

        $message = sprintf(Entities\ExceptionMessages::INCORRECT_ARGUMENTS_COUNT, implode(', ', $correct_counts));
        parent::__construct($message);
    }
}