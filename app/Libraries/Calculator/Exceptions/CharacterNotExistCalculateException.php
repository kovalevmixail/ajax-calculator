<?php

namespace App\Libraries\Calculator\Exceptions;

use App\Libraries\Calculator\Entities;

/**
 * Class CharacterNotExistCalculateException extends CalculateException
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class CharacterNotExistCalculateException extends CalculateException
{
    public function __construct($char) {

        $message = sprintf(Entities\ExceptionMessages::CHARACTER_NOT_EXIST, $char);
        parent::__construct($message);
    }
}