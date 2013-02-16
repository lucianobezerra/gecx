<?php

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$id = $_REQUEST['id'];

$item = new Item();
$item->valorpk = $id;
$item->seleciona($item);

$linha = $item->retornaDados("array");
if ($linha > 0) {
  echo $linha['title'] . '|' . $linha['available_copies'];
} else {
  echo "";
}
?>
