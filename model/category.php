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
  $category = new Category();
  $category->setValor('description', strtoupper($_POST['description']));
  $category->setValor('ativo',       $_POST['ativo']);
  $category->inserir($category);
}

function alterar($id){
  $category = new Category();
  $category->setValor('description', strtoupper($_POST['description']));
  $category->setValor('ativo',       $_POST['ativo']);
  $category->valorpk = $id;
  $category->atualizar($category);
}

function excluir($id){
  $category = new Category();
  $category->valorpk = $id;
  $category->excluir($category);
}

function desativar($id){
  $category = new Category();
  $category->valorpk = $id;
  $category->desativar($category);
}

?>
