<?php

namespace App\Libraries\Calculator\Operators;

use App\Libraries\Calculator\Entities;

/**
 * Class AdditionOperator
 * Оператор сложения
 *
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class AdditionOperator extends Operator
{

    /**
     * Данные об операторе
     *
     * @var array
     */
    const OPERATOR_INFO = Entities\Operators::OPERATORS['Addition'];


    /**
     * Расчет суммы аргументов
     *
     * @return number
     */
    public function _action()
    {
        $sum = 0;
        foreach ($this->_args as $arg) {
            $sum += $arg;
        }

        return $sum;
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