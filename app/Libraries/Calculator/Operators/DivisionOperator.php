<?php

namespace App\Libraries\Calculator\Operators;

use App\Libraries\Calculator\Entities;
use App\Libraries\Calculator\Exceptions;


/**
 * Class DivisionOperator extends Operator
 * Оператор деления
 *
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class DivisionOperator extends Operator
{
    /**
     * Данные об операторе
     *
     * @var array
     */
    const OPERATOR_INFO = Entities\Operators::OPERATORS['Division'];

    /**
     * Расчет значения деления аргументов
     *
     * @return number
     */
    public function _action()
    {
        $result = $this->_args[0];
        for ($i = 1; $i < count($this->_args); $i++) {
            $result /= $this->_args[$i];;
        }

        return $result;
    }

    /**
     * Валидация аргументов
     *
     * @param array $args
     * @throws \App\Libraries\Calculator\Exceptions\IncorrectArgumentsCountCalculateException
     * @throws \App\Libraries\Calculator\Exceptions\NotNumericArgumentCalculateException
     * @throws \App\Libraries\Calculator\Exceptions\NullValueCalculateException
     * @throws \App\Libraries\Calculator\Exceptions\DivisionByZeroCalculateException
     */
    protected function validateArgs(array $args = array())
    {
        if (empty($args)) {
            $args = $this->_args;
        }

        $this->baseValidation($args);

        //делить на ноль нельзя
        if ($args[1] == 0)
            throw new Exceptions\DivisionByZeroCalculateException();
    }
}