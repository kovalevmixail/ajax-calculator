<?php

namespace App\Libraries\Calculator;

use App\Libraries\Calculator\Entities;
use App\Libraries\Calculator\Operators;
use App\Libraries\Calculator\Exceptions;

/**
 * Class Calculator
 * @package App\Libraries\Calculator
 */
class Calculator
{
    /**
     * Едиственная публичная функция, входная точка в калькулятор
     *
     * @param string|array $expression
     * @return number
     * @throws Exceptions\IncorrectExpressionCalculateException
     */
    public function calculate($expression)
    {
        if (is_string($expression)) {
            $expression = $this->_parseSimpleStringExpression($expression);
        }
        
        if ($this->_validateExpressionArray($expression))
        {
            return $this->_calculate(
                $expression['operatorCharacter'],
                $expression['args']
            );
        }

        throw new Exceptions\IncorrectExpressionCalculateException();
    }

    /**
     * Проверяет, что присутствует все необходимое для вычислений
     *
     * @param $exprArr
     * @return bool
     */
    private function _validateExpressionArray($exprArr)
    {
        return (
            is_array($exprArr)
            && !empty($exprArr)

            && isset($exprArr['operatorCharacter'])
            && !empty($exprArr['operatorCharacter'])
            && in_array($exprArr['operatorCharacter'], self::supportedCharacters())

            && isset($exprArr['args'])
            && is_array($exprArr['args'])
            && !empty($exprArr['args'])
        );
    }


    /**
     * Парсинг строки с выражением типа "2+2"
     *
     * @param string $expression
     * @return array - array(
     *                  'operatorCharacter' @var string
     *                  'args' @var array
     *                  );
     */
    private function _parseSimpleStringExpression($expression)
    {
        foreach (self::supportedCharacters() as $operatorCharacter) {
            $args = explode($operatorCharacter, $expression);
            if (count($args) > 1) {
                return array(
                    'operatorCharacter' => $operatorCharacter,
                    'args' => $args
                );
            }
        }

        return array();
    }

    /**
     * Создание оператора и вычисление
     *
     * @param string $operatorCharacter
     * @param array $args
     * @throws Exceptions\CharacterNotExistCalculateException
     * @throws Exceptions\CalculateException
     * @return number Результат вычислений
     */
    private function _calculate($operatorCharacter, array $args)
    {
        $operator = $this->_makeOperatorByCharacter($operatorCharacter);

        return $operator
            ->setArgs($args)
            ->action();
    }


    /**
     * Создание экземпляра класса оператора по $char
     *
     * @param string $char
     * @return Operators\Operator
     * @throws Exceptions\CharacterNotExistCalculateException
     * @throws Exceptions\OperatorNotExistCalculateException
     */
    private function _makeOperatorByCharacter($char)
    {
        if (in_array($char, self::supportedCharacters())) {

            foreach (self::operatorsMap() as $operatorCharacter => $operatorClassName) {
                if ($char === $operatorCharacter) {
                    return $this->_makeOperatorByClassName($operatorClassName);
                }
            }
        }

        throw new Exceptions\CharacterNotExistCalculateException($char);
    }

    /**
     * Создание экземпляра класса оператора по $className
     *
     * @param $className
     * @return mixed
     * @throws Exceptions\OperatorNotExistCalculateException
     */
    private function _makeOperatorByClassName($className)
    {
        if (in_array($className, self::operatorsMap())) {
            $className = '\App\Libraries\Calculator\Operators\\' . $className;

            if (class_exists($className)) {
                return new $className;
            }
        }

        throw new Exceptions\OperatorNotExistCalculateException($className);
    }

    /**
     * @return array
     */
    public static function supportedCharacters() {
        return Entities\Operators::getSupportedCharacters();
    }

    /**
     * @return array
     */
    public static function operatorsMap() {
        return Entities\Operators::getCharacterOperatorMap();
    }
}