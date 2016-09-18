<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Libraries\Calculator;

/**
 * Class CalculatorController
 * @package App\Http\Controllers
 * @author Mikhail Kovalev <kovalev.mixail@gmail.com>
 */
class CalculatorController extends Controller
{

    /**
     * @var Calculator\Calculator
     */
    protected $calculator;

    /**
     * Имя jsonp функции
     *
     * @var string
     */
    protected $jsonp_callback = null;

    /**
     * текст ответа
     *
     * @var string
     */
    protected $response = null;

    /**
     * CalculatorController constructor.
     */
    public function __construct()
    {
        $this->calculator = new Calculator\Calculator();
        header('Content-Type: text/javascript; charset=utf8');
    }

    /**
     * Метод принимает запрос; вызывает парсинг, валидацию, вычисления; отдает ответ
     *
     * @param Request $request
     * @return response();
     */
    public function calculate(Request $request)
    {
        //определяем jsonp это или ajax запрос
        $this->jsonp_callback = $request->get('callback');

        //валидация выражения
        $expression = $this->_validation($request);

        //если валидация прошла неуспешно, то $this->response будет заполнен
        if ($this->response !== null)
            //отдаем ответ с ошибкой валидации
            return response($this->response);


        try {

            //считаем выражение
            $result = $this->calculator->calculate($expression);

        } catch (Calculator\Exceptions\CalculateException $e) {

            //отдаем ошибку при расчете
            $this->setResponse([
                'status' => 'fail',
                'error' => $e->getMessage()
            ]);
            return response($this->response);
        }

        //если мы сюда пришли, то все ок, отдаем результат
        $this->setResponse([
            'status' => 'ok',
            'result' => $result
        ]);
        return response($this->response);
    }

    /**
     * Валидация запроса.
     * Если все ОК, то возвращает выражение, если нет - 422 ответ с json типа {"expression" : "error_message"}
     *
     * @param Request $request
     * @return string|ничего
     */
    private function _validation(Request $request)
    {

        //допустимые математические символы
        $operatorsStr = implode('', $this->calculator->supportedCharacters());
        //регулярка для проверки выражения с двумя целыми числами и знака оператора между ними
        $regex_2IntArgs = '^' . '\d+' . '[' . preg_quote($operatorsStr) . ']' . '\d+' . '$';

        $validator = Validator::make($request->all(), [
            'expression' => "required|regex:@{$regex_2IntArgs}@",
        ]);

        if ($validator->fails()) {
            $this->setResponse([
                'status' => 'fail',
                'error' => $validator->errors()->first('expression')
            ]);
        } else {
            return $request->get('expression');
        }
    }

    /**
     * Устанавливает текст ответа
     *
     * @param array $data
     */
    public function setResponse(array $data)
    {
        if ($this->jsonp_callback !== null) {
            $this->response = $this->jsonp_callback . '(' . json_encode($data) . ');';
        } else {
            $this->response = json_encode($data);
        }
    }

}
