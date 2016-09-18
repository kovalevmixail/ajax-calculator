
//Конфиг
var ajaxcalc_jsonp = false,
    ajaxcalc_host = 'http://192.168.33.10',
    ajaxcalc_path = '/api/calculate';

$(function () {
    var $form = $('#js-ajaxCalc'),
        $answer = $('#answer'),
        $expression = $('#expression');

    var removeErrors = function () {
        $expression.removeClass('error');
        $answer.find('span.error').remove();
    };

    var clearForm = function () {
        $expression.removeClass('error');
        $('#answer').html('');
    };

    var setSuccessResponse = function (result) {
        $answer.append('<span class="success">' + result + '</span>');
    };

    var setFailResponse = function (error) {
        $expression.addClass('error');
        $answer.append('<span class="error">' + error + '</span>');
    };

    var failRequest = function (url) {
        alert('Ошибка при запросе ' + url);
    };

    var setResponse = function (data) {
        if (!data.status) return failRequest(ajaxcalc_path);

        if (data.status === 'ok') {
            return   setSuccessResponse(data.result);
        }

        if (data.status === 'fail') {
            return  setFailResponse(data.error);
        }

        return failRequest(ajaxcalc_path);
    };

    //запрос данных через JsonP
    var viaJsonp = function (expression_value) {
        var url = ajaxcalc_host + ajaxcalc_path + '?expression=' + encodeURIComponent(expression_value);

        scriptRequest(url, setResponse, failRequest);
    };

    //запрос данных через ajax
    var viaAjax = function (expression_value) {
        $.get(
            ajaxcalc_path,
            {'expression' : expression_value},
            function (data) {
                setResponse(data);
            },
            "json")
            .fail(function () {
                failRequest(ajaxcalc_path);
            });
    };


    $expression.focus(function () {
        removeErrors();
    });

    $form.submit(function () {
        clearForm();

        var expression_value = $.trim($expression.val());
        expression_value = expression_value.replace(/\s+/g, ''); //remove spaces

        if (ajaxcalc_jsonp) {
            viaJsonp(expression_value);
        } else {
            viaAjax(expression_value);
        }

        return false;
    })
});




//from https://learn.javascript.ru/ajax-jsonp#полный-пример

var CallbackRegistry = {}; // реестр

// при успехе вызовет onSuccess, при ошибке onError
function scriptRequest(url, onSuccess, onError) {

    var scriptOk = false; // флаг, что вызов прошел успешно

    // сгенерировать имя JSONP-функции для запроса
    var callbackName = 'cb' + String(Math.random()).slice(-6);

    // укажем это имя в URL запроса
    url += ~url.indexOf('?') ? '&' : '?';
    url += 'callback=CallbackRegistry.' + callbackName;

    // ..и создадим саму функцию в реестре
    CallbackRegistry[callbackName] = function (data) {
        scriptOk = true; // обработчик вызвался, указать что всё ок
        delete CallbackRegistry[callbackName]; // можно очистить реестр
        onSuccess(data); // и вызвать onSuccess
    };

    // эта функция сработает при любом результате запроса
    // важно: при успешном результате - всегда после JSONP-обработчика
    function checkCallback() {
        if (scriptOk) return; // сработал обработчик?
        delete CallbackRegistry[callbackName];
        onError(url); // нет - вызвать onError
    }

    var script = document.createElement('script');

    // в старых IE поддерживается только событие, а не onload/onerror
    // в теории 'readyState=loaded' означает "скрипт загрузился",
    // а 'readyState=complete' -- "скрипт выполнился", но иногда
    // почему-то случается только одно из них, поэтому проверяем оба
    script.onreadystatechange = function () {
        if (this.readyState == 'complete' || this.readyState == 'loaded') {
            this.onreadystatechange = null;
            setTimeout(checkCallback, 0); // Вызвать checkCallback - после скрипта
        }
    };

    // события script.onload/onerror срабатывают всегда после выполнения скрипта
    script.onload = script.onerror = checkCallback;
    script.src = url;

    document.body.appendChild(script);
}