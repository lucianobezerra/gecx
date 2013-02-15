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
  $user = new User();
  $user->setValor('username', $_POST['username']);
  $user->setValor('name',     $_POST['name']);
  $user->setValor('password', $user->encrypt($_POST['password']));
  $user->setValor('ativo',    $_POST['ativo']);
  $user->inserir($user);
}

function alterar($id){
  $user = new User();
  $user->setValor('name', $_POST['name']);
  $user->setValor('ativo', $_POST['ativo']);
  $user->valorpk = $id;
  $user->delCampo("username");
  $user->delCampo("password");
  $user->atualizar($user);
}

function excluir($id){
  $user = new User();
  $user->valorpk = $id;
  $user->excluir($user);
}

function desativar($id){
  $user = new User();
  $user->valorpk = $id;
  $user->desativar($user);
}

?>
