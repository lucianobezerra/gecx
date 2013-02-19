<?php

function __autoload($classe) {
  require "class/{$classe}.class.php";
}
$objLogin = new Login();
$objLogin->logout('login.html');
?>
