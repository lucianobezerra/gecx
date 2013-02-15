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
}

function inserir(){
  $item = new Item();
  $item->setValor('category_id',        $_POST['category_id']);
  $item->setValor('type_id',            $_POST['type_id']);
  $item->setValor('author_id',          $_POST['author_id']);  
  $item->setValor('publisher_id',       $_POST['publisher_id']);  
  $item->setValor('isbn',               $_POST['isbn']);
  $item->setValor('title',   strtoupper($_POST['title']));
  $item->setValor('subtitle',strtoupper($_POST['subtitle']));
  $item->setValor('pages',              $_POST['pages']);
  $item->setValor('existing_copies',    $_POST['existing_copies']);
  $item->setValor('available_copies',   $_POST['existing_copies']);
  $item->setValor('ativo',              $_POST['ativo']);
  $item->inserir($item);
}

function alterar($id){
  $item = new Item();
  $item->setValor('category_id',        $_POST['category_id']);
  $item->setValor('type_id',            $_POST['type_id']);
  $item->setValor('author_id',          $_POST['author_id']);  
  $item->setValor('publisher_id',       $_POST['publisher_id']);  
  $item->setValor('isbn',               $_POST['isbn']);
  $item->setValor('title',   strtoupper($_POST['title']));
  $item->setValor('subtitle',strtoupper($_POST['subtitle']));
  $item->setValor('pages',              $_POST['pages']);
  $item->setValor('existing_copies',    $_POST['existing_copies']);
  $item->setValor('ativo',              $_POST['ativo']);
  $item->valorpk = $id;
  $item->delCampo("available_copies");
  $item->atualizar($item);
}

function excluir($id){
  $item = new Item();
  $item->valorpk = $id;
  $item->excluir($item);
}

function desativar($id){
  $item = new Item();
  $item->valorpk = $id;
  $item->desativar($item);
}

?>