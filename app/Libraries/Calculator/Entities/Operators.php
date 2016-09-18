<?php

namespace App\Libraries\Calculator\Entities;

/**
 * Class Operators
 * @package App\Libraries\Calculator
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 * @date: 15.09.16
 */
class Operators
{
    /**
     * Конфигурация операторов
     *
     * @var array(
     *   @var array  'characters' - символьные обозначения оператора,
     *   @var string 'class_name' - имя класса оператора,
     *   @var array  'args_count' - варинаты количества передаваемых аргументов
     * )
     */
    const OPERATORS = array(

        //Сложение
        'Addition' => array(
            'characters' => array('+'),
            'class_name' => 'AdditionOperator',
            'args_count' => array(2)
        ),

        //Вычитание
        'Subtraction' => array(
            'characters' => array('-'),
            'class_name' => 'SubtractionOperator',
            'args_count' => array(2)
        ),

        //Умножение
        'Multiplication' => array(
            'characters' => array('*'),
            'class_name' => 'MultiplicationOperator',
            'args_count' => array(2)
        ),

        //Деление
        'Division' => array(
            'characters' => array('/', ':'),
            'class_name' => 'DivisionOperator',
            'args_count' => array(2)
        ),
    );


    /**
     * Возвращает массив поддерживаемых символьных обозначений операторов
     *
     * @return array
     */
    public static function getSupportedCharacters()
    {
        $characters = array();

        foreach (self::OPERATORS as $operatorName => $operatorInfo) {
            $characters = array_merge($characters, $operatorInfo['characters']);
        }

        return $characters;
    }

    /**
     * Возвращает ассоциативный массив соотвествия символа какому-либо оператору
     *
     * @return array
     */
    public static function getCharacterOperatorMap()
    {
        $map = array();

        foreach (self::OPERATORS as $operatorName => $operatorInfo) {
            foreach ($operatorInfo['characters'] as $char) {
                $map[$char] = $operatorInfo['class_name'];
            }
        }

        return $map;
    }

}