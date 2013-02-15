<?php

function __autoload($classe) {
  require "../class/{$classe}.class.php";
}

$acao = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : null;
$id   = isset($_REQUEST['id'])   ? $_REQUEST['id']   : null;

switch ($acao) {
  case "inserir":   inserir();      break;
  case "alterar":   alterar($id);   break;
  case "excluir":   excluir($id);   break;
  case "desativar": desativar($id); break;
}

function inserir(){
  $type = new Type();
  $type->setValor('description', strtoupper($_POST['description']));
  $type->setValor('ativo',       $_POST['ativo']);
  $type->inserir($type);
}

function alterar($id){
  $type = new Type();
  $type->setValor('description', strtoupper($_POST['description']));
  $type->setValor('ativo',       $_POST['ativo']);
  $type->valorpk = $id;
  $type->atualizar($type);
}

function excluir($id){
  $type = new Type();
  $type->valorpk = $id;
  $type->excluir($type);
}

function desativar($id){
  $type = new Type();
  $type->valorpk = $id;
  $type->desativar($type);
}

?>
