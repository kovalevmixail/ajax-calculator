<?php

namespace App\Libraries\Calculator\Operators;

use App\Libraries\Calculator\Exceptions;

/**
 * Class Operator
 * Базовый класс для других операторов
 *
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
abstract class Operator
{

    /**
     * Данные об операторе
     *
     * @var array
     */
    const OPERATOR_INFO = array();

    /**
     * Аргументы выражения
     *
     * @var array
     */
    protected $_args = array();


    /**
     * Operator constructor.
     * 
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        if (!empty($args)) {
            $this->setArgs($args);
        }

    }

    /**
     * Валидация и вычисление
     *
     * @return number результат вычисления
     */
    public function action() {

        $this->validateArgs();

        return $this->_action();
    }

    /**
     * Производит расчет и возвращает результат
     *
     * @return number результат вычисления
     */
    abstract public function _action();

    /**
     * Проверяет, валидны ли аргументы
     *
     * @param array $args
     * @throws \App\Libraries\Calculator\Exceptions\CalculateException
     */
    abstract protected function validateArgs(array $args = array());

    /**
     * Сеттер для $this->_args
     *
     * @param array $args
     * @return $this
     */
    public function setArgs(array $args)
    {
        $this->validateArgs($args);

        $this->_args = $args;

        return $this;
    }

    /**
     * Самая очевидная базовая валидация. Проверяет:
     * - соответствие количества аргументов заданным OPERATOR_INFO['args_count']
     * - ни один аргумент не равен null
     * - каждый аргумент это число
     *
     * @param array $args
     * @throws Exceptions\IncorrectArgumentsCountCalculateException
     * @throws Exceptions\NotNumericArgumentCalculateException
     * @throws Exceptions\NullValueCalculateException
     */
    protected function baseValidation(array $args = array())
    {
        if (empty($args)) $args = $this->_args;

        if (!in_array(count($args), static::OPERATOR_INFO['args_count']))
            throw new Exceptions\IncorrectArgumentsCountCalculateException(static::OPERATOR_INFO['args_count']);

        foreach ($args as $index => $arg) {
            if ($arg === null)
                throw new Exceptions\NullValueCalculateException($index);

            if (!is_numeric($arg))
                throw new Exceptions\NotNumericArgumentCalculateException($index);
        }
    }
}


