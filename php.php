<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php

function revertPunctuationMarks($str)
{
    $result = '';
    if (is_string($str)) {
        $marks = array_reverse(str_split(preg_replace('|[\wа-яёА-ЯЁa-zA-Z ]|u', '', $str)));
        $words = preg_split("|[^\wа-яёА-ЯЁa-zA-Z ]|u", $str);
        var_dump($marks);
        var_dump($words);

        foreach ($words as $key => $word) {
            $result .= $word . $marks[$key];
        }
        echo 'Result: ' . $result . '<br>';
    } else echo 'str is not string <br>';

    return $result;
}

//Тесты

//проверка на пустую строку
function emptyStringTest() {
    if (revertPunctuationMarks('')==='') echo '*emptyStringTest passed!*<br>';
    else echo '*emptyStringTest failed!*<br>';
}
//проверка на нестроковый тип переменной
function notStringTest() {
    $arr = array("hello", "world");
    if (revertPunctuationMarks($arr)==='') echo '*notStringTest passed!*<br>';
    else echo '*notStringTest failed!*<br>';
}
//проверка обработки кириллицы
function cyrillicTest() {
    if (revertPunctuationMarks('Привет! Как дела?')==='Привет? Как дела!') echo '*cyrillicTest passed!*<br>';
    else echo '*cyrillicTest failed!*<br>';
}
//проверка обработки латиницы
function latinTest() {
    if (revertPunctuationMarks('Hi! How are you?')==='Hi? How are you!') echo '*latinTest passed!*<br>';
    else echo '*latinTest failed!*<br>';
}
//проверка обработки чисел в строке
function nubersTest() {
    if (revertPunctuationMarks('555! 354564 ? 877)) 76444&')==='555& 354564 ) 877)? 76444!') echo '*nubersTest passed!*<br>';
    else echo '*nubersTest failed!*<br>';
}
//проверка обработки кириллицы, латиницы и чисел вместе
function mixedTest() {
    if (revertPunctuationMarks('Hi11! 5) Как дела2?55')==='Hi11? 5) Как дела2!55') echo '*mixedTest passed!*<br>';
    else echo '*mixedTest failed!*<br>';
}
//проверка обработки знаков препинания, стоящих вместе
function multPunctTest() {
    if (revertPunctuationMarks('Привет!! Как дела???')==='Привет?? Как дела?!!') echo '*multPunctTest passed!*<br>';
    else echo '*multPunctTest failed!*<br>';
}


emptyStringTest();
notStringTest();
cyrillicTest();
latinTest();
nubersTest();
mixedTest();
multPunctTest();