<?php
require_once '../util/funcoes.php';

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
  case "pegaNome": pegaNome($id);   break;
}

function inserir(){
  $reader = new Reader();
  $reader->setValor('name',         strtoupper($_POST['name']));
  $reader->setValor('address',      strtoupper($_POST['address']));
  $reader->setValor('neighborhood', strtoupper($_POST['neighborhood']));
  $reader->setValor('phone1',       strtoupper($_POST['phone1']));
  $reader->setValor('phone2',       strtoupper($_POST['phone2']));
  $reader->setValor('email',        strtolower($_POST['email']));
  $reader->setValor('city_id',      strtoupper($_POST['city_id']));
  $reader->setValor('state_id',     strtoupper($_POST['state_id']));
  $reader->setValor('birth',           dataEUA($_POST['birth']));
  $reader->setValor('ativo',                   $_POST['ativo']);
  $reader->delCampo("entry");
  $reader->inserir($reader);
}

function alterar($id){
  $reader = new Reader();
  $reader->setValor('name',         strtoupper($_POST['name']));
  $reader->setValor('address',      strtoupper($_POST['address']));
  $reader->setValor('neighborhood', strtoupper($_POST['neighborhood']));
  $reader->setValor('phone1',       strtoupper($_POST['phone1']));
  $reader->setValor('phone2',       strtoupper($_POST['phone2']));
  $reader->setValor('email',        strtolower($_POST['email']));
  $reader->setValor('city_id',      strtoupper($_POST['city_id']));
  $reader->setValor('state_id',     strtoupper($_POST['state_id']));
  $reader->setValor('birth',           dataEUA($_POST['birth']));
  $reader->setValor('ativo',                   $_POST['ativo']);
  $reader->delCampo("entry");
  $reader->valorpk = $id;
  $reader->atualizar($reader);
}

function excluir($id){
  $reader = new Reader();
  $reader->valorpk = $id;
  $reader->excluir($reader);
}

function desativar($id){
  $reader = new Reader();
  $reader->valorpk = $id;
  $reader->desativar($reader);
}

?>
