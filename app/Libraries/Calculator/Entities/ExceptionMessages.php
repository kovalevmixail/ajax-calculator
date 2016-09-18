<?php

namespace App\Libraries\Calculator\Entities;

/**
 * Class ExceptionMessages
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class ExceptionMessages
{
    const NULL_VALUE = "%d значение не задано!";

    const INCORRECT_ARGUMENTS_COUNT = "Некорректное количество передаваемых аргументов. Возможные значения: %s";

    const DIVISION_BY_ZERO = "Деление на ноль невозможно!";

    const OPERATOR_NOT_EXIST = "Оператор %s не существует";

    const CHARACTER_NOT_EXIST = "Символ '%s' не поддерживается калькулятором";

    const INCORRECT_EXPRESSION = "Калькулятору передано некорректное выражение";

    const NOT_NUMERIC_ARGUMENTS = "Аргумент №%d не является числом";


}