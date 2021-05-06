<?php

ob_start(); // Начало буфферизации
include_once "action.php";
include "header.php";

if (isset($_POST['go'])) {
    $login = $_POST['login'];
    $password = $_POST['pass'];
    if (check_autorize($login, $password)) {
        if (check_admin($login, $password)) {
            // echo "Приветствуем Вас, $login!"; // Вариант
            // echo "<a href='report.php'>Просмотр отчета</a>"; // Вариант
            header("Location: hello.php?login=$login");
            ob_end_flush(); // Конец буфферизации
        } else
            echo "Приветствуем Вас, $login!";
    } else {
        echo "Вы не зарегистрированы!";
    }
}

if (isset($_POST['clear'])) { // Если нажата кнопка 'Clear'
    unset($_POST['gosort']); // Удаление массива $_POST
    unset($_POST['gosearch']);
    header("Location:" . $_SERVER['PHP_SELF']); // Перечитываем ту же страницу
    exit; // Выход
}

$str_form = "<span id='massage'></span>
			<form  name='autoForm' action='index.php' method='post' onSubmit='return overify_login(this);' >
 			 Логин: <input type='text' name='login'>
 			 Пароль: <input type='password' name='pass'>
 			 <input type='submit' name='go' value='Подтвердить'>
 		     </form>";
echo $str_form;

$str_form_sort = '<h3>Сортировать по:</h3>
<form action="index.php" name="sortForm" method="post">
 <select name="sort" size="1">
   <option value="name">Названию фильма</option>
   <option value="producer">Режиссеру</option>
   <option value="genre">Жанру</option>
   <option value="studio">Киностудии</option>
   <option value="year">Году</option>
   <option value="cost">Стоимости билета</option>
 </select>
 <input name="gosort" type="submit" value="Подтвердить">
</form>';
echo $str_form_sort;

if (isset($_POST['gosort'])) {
    sorting($_POST['sort']);
}
// блок отображения информации
$out = out_arr();
// вызов функции out_arr() из action.php для получения массива
if (count($out) > 0) {
    foreach ($out as $row) {//вывод массива построчно
        echo $row;
    }
} else// если нет данных
    echo "Нет данных...";


$str_form_search = "<h3>Поиск:</h3>
			<form  name='searchForm' action='index.php' method='post' onSubmit='return overify_login(this);' >
 			 <input type='text' name='search'>
 			 <input type='submit' name='gosearch' value='Подтвердить'>
 			 <input type='submit' name='clear' value='Сбросить'>
 		     </form>";

echo $str_form_search;

if (isset($_POST['gosearch'])) {
    $data = test_input($_POST['search']);
    $out = out_search($data);

// вызов функции out_arr() из action.php для получения массива
    if (count($out) > 0) {
        foreach ($out as $row) {//вывод массива построчно
            echo $row;
        }
    } else// если нет данных
        echo "Ничего не найдено...";
    
//include "content.php"; // Можно вынести таблицу в отдельный файл
    
}
include "footer.php";
