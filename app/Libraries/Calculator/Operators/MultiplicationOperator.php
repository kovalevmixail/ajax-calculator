<?php

namespace App\Libraries\Calculator\Operators;

use App\Libraries\Calculator\Entities;

/**
 * Class MultiplicationOperator extends Operator
 * Оператор умножения
 *
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class MultiplicationOperator extends Operator
{
    /**
     * Данные об операторе
     *
     * @var array
     */
    const OPERATOR_INFO = Entities\Operators::OPERATORS['Multiplication'];

    /**
     * Расчет прозведения аргументов
     *
     * @return number
     */
    public function _action()
    {
        $result = 1;
        foreach ($this->_args as $arg) {
            $result *= $arg;
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
     */
    protected function validateArgs(array $args = array())
    {
        if (empty($args)) {
            $args = $this->_args;
        }

        $this->baseValidation($args);
    }
}