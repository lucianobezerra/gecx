<?php
include_once './class/Acesso.class.php';

$acesso = new Acesso();
if ($acesso->autentica($_POST['login'], $_POST['senha'])) {
  echo false;
} else {
  echo 'Usuário e/ou senha inválidos';
}
?>
