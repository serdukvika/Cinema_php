<?php
include "db.php";

function out_arr() {
    global $countries; // делаем переменную $countries глобальной
    $arr_out = array();
    $arr_out[] = "<table class='out'>";
    $arr_out[] = "<tr><td>№</td><td>Название фильма</td><td>Режиссер</td><td>Жанр</td><td>Киностудия</td><td>Год</td><td>Стоимость билета</td></tr>";
    foreach ($countries as $country) {
        static $i = 1;
        //статическая глобальная переменная-счетчик
        $str = "<tr>";
        $str .= "<td>" . $i . "</td>";
        foreach ($country as $key => $value) {
            if (!is_array($value))
                $str .= "<td>$value</td>";
            else {
                foreach ($value as $k => $v)
                    $str .= "<td>$v</td>";
            }
        }
        $str .= $country['cost'];
        
        $arr_out[] = $str;
        $i++;
    }
    $arr_out[] = "</table>";
    return $arr_out;
}

function out_arr_search(array $arr_index = null) {
    global $countries; // делаем переменную $countries глобальной    
    $arr_out = array();
    $arr_out[] = "<table class='out'>";
    $arr_out[] = "<tr><td>№</td><td>Название фильма</td><td>Режиссер</td><td>Жанр</td><td>Киностудия</td><td>Год</td><td>Стоимость билета</td></tr>";
    foreach ($countries as $index => $country) {
        if ($arr_index != null && in_array($index, $arr_index)) {
            static $i = 1;
            $str = "<tr>" . "<td>" . $i . "</td>";
            foreach ($country as $key => $value) {
                if (!is_array($value)) {
                    $str .= "<td>$value</td>";
                } else {
                    foreach ($value as $k => $v) {
                        $str .= "<td>$v</td>";
                    }
                }
            }
            $str .= $country['cost'];
            $arr_out[] = $str;
            $i++;
        }
    }
    $arr_out[] = "</table>";
    return $arr_out;
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function out_search($data) {
    global $countries;    // делаем переменную $countries глобальной
    $arr_index = array();
    foreach ($countries as $country_number => $country) {
        foreach ($country as $key => $value) {
            if (!is_array($value)) {
                if (strstr($value, $data)){
                    $arr_index[] = $country_number;
                }
            }
            else {
                foreach ($value as $k => $v) {
                    if (strstr($v, $data) || strstr($k, $data)) {
                        $arr_index[] = $country_number;
                    }
                }
            }
        }
    }
    return out_arr_search(array_unique($arr_index));
}

function check_autorize($log, $pas) {
    global $users;
    if (in_array($log, $users)) {
        return true;
    } else {
        return false;
    }
}

function check_admin($log, $pas) {
    global $users;
    if (in_array($log, $users) && ($pas == $users["admin"])) {
        return true;
    } else {
        return false;
    }
}

function check_log($log) {
    if ($log == "admin") {
        return true;
    } else {
        return false;
    }
}

function name($a, $b) { // функция, определяющая способ сортировки (по названию столицы)
    if ($a["name"] < $b["name"])
        return -1;
    elseif ($a["name"] == $b["name"])
        return 0;
    else
        return 1;
}

function producer($a, $b) { // функция, определяющая способ сортировки (по названию столицы)
    if ($a["producer"] < $b["producer"])
        return -1;
    elseif ($a["producer"] == $b["producer"])
        return 0;
    else
        return 1;
}

function genre($a, $b) { // функция, определяющая способ сортировки (по площади)
    if ($a["genre"] < $b["genre"])
        return -1;
    elseif ($a["genre"] == $b["genre"])
        return 0;
    else
        return 1;
}

function studio($a, $b) { // функция, определяющая способ сортировки (по площади)
    if ($a["studio"] < $b["studio"])
        return -1;
    elseif ($a["studio"] == $b["studio"])
        return 0;
    else
        return 1;
}
function year($a, $b) { // функция, определяющая способ сортировки (по площади)
    if ($a["year"] < $b["year"])
        return -1;
    elseif ($a["year"] == $b["year"])
        return 0;
    else
        return 1;
}

function cost($a, $b) { // функция, определяющая способ сортировки (по площади)
    if ($a["cost"] < $b["cost"])
        return -1;
    elseif ($a["cost"] == $b["cost"])
        return 0;
    else
        return 1;
}

function sorting($p) {
    global $countries;
    uasort($countries, $p);
}
