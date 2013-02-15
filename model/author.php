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
  $author = new Author();
  $author->setValor('name',  strtoupper($_POST['name']));
  $author->setValor('birth',   dataEUA($_POST['birth']));
  $author->setValor('ativo',            $_POST['ativo']);
  $author->inserir($author);
}

function alterar($id){
  $author = new Author();
  $author->setValor('name',  strtoupper($_POST['name']));
  $author->setValor('birth',   dataEUA($_POST['birth']));
  $author->setValor('ativo',            $_POST['ativo']);
  $author->valorpk = $id;
  $author->atualizar($author);
}

function excluir($id){
  $author = new Author();
  $author->valorpk = $id;
  $author->excluir($author);
}

function desativar($id){
  $author = new Author();
  $author->valorpk = $id;
  $author->desativar($author);
}

?>
