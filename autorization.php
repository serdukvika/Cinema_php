<?php
$form = "<form  name='autoForm' action='index.php' method='post' onSubmit='return overify_login(this);' >
 			 Логин: <input type='text' name='login'>
 			 Пароль: <input type='password' name='pas'>
 			 <input type='submit' name='go' value='Подтвердить'>
 		     </form>";
echo $str_form;