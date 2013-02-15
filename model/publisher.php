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
  $publisher = new Publisher();
  $publisher->setValor('name',         strtoupper($_POST['name']));
  $publisher->setValor('address',      strtoupper($_POST['address']));
  $publisher->setValor('neighborhood', strtoupper($_POST['neighborhood']));
  $publisher->setValor('city_id',      $_POST['city_id']);
  $publisher->setValor('state_id',     $_POST['state_id']);
  $publisher->setValor('phone',        $_POST['phone']);
  $publisher->setValor('email',        strtolower($_POST['email']));
  $publisher->setValor('ativo',        $_POST['ativo']);
  $publisher->inserir($publisher);
}

function alterar($id){
  $publisher = new Publisher();
  $publisher->setValor('name',         strtoupper($_POST['name']));
  $publisher->setValor('address',      strtoupper($_POST['address']));
  $publisher->setValor('neighborhood', strtoupper($_POST['neighborhood']));
  $publisher->setValor('city_id',      $_POST['city_id']);
  $publisher->setValor('state_id',     $_POST['state_id']);
  $publisher->setValor('phone',        $_POST['phone']);
  $publisher->setValor('email',        strtolower($_POST['email']));
  $publisher->setValor('ativo',        $_POST['ativo']);
  $publisher->valorpk = $id;
  $publisher->atualizar($publisher);
}

function excluir($id){
  $publisher = new Publisher();
  $publisher->valorpk = $id;
  $publisher->excluir($publisher);
}

function desativar($id){
  $publisher = new Publisher();
  $publisher->valorpk = $id;
  $publisher->desativar($publisher);
}

?>
