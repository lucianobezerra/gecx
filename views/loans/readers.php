<?php

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$id = $_REQUEST['id'];

$reader = new Reader();
$reader->valorpk = $id;
$reader->seleciona($reader);

$linha = $reader->retornaDados("array");
if ($linha > 0) {
  echo $linha['name'];
} else {
  echo "";
}
?>
