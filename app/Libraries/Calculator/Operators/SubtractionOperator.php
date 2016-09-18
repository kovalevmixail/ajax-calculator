<?php

namespace App\Libraries\Calculator\Operators;

use App\Libraries\Calculator\Entities;

/**
 * Class SubtractionOperator extends Operator
 * Оператор сложения
 *
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class SubtractionOperator extends Operator
{
    /**
     * Данные об операторе
     *
     * @var array
     */
    const OPERATOR_INFO = Entities\Operators::OPERATORS['Subtraction'];

    /**
     * Расчет разности аргументов
     *
     * @return number
     */
    public function _action()
    {
        $result = $this->_args[0];
        for ($i = 1; $i < count($this->_args); $i++) {
            $result -= $this->_args[$i];;
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