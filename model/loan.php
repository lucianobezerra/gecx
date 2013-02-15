<?php
require_once '../util/funcoes.php';
function __autoload($classe) {
  require "../class/{$classe}.class.php";
}

$acao = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : null;
$id   = isset($_REQUEST['id'])   ? $_REQUEST['id']   : null;

switch ($acao) {
  case "inserir":  inserir();     break;
  case "alterar":  alterar($id);  break;
  case "excluir":  excluir($id);  break;
  case "devolver": devolver($id); break;
}

function inserir(){
  $loan = new Loan();
  $loan->setValor('item_id',   $_POST['item_id']);
  $loan->setValor('reader_id', $_POST['reader_id']);
  $loan->setValor('prevision', dataEUA($_POST['prevision']));
  $loan->delCampo('entry');
  $loan->delCampo('devolution');
  $loan->inserir($loan);
}

function alterar($id){
  $loan = new Loan();
  $loan->setValor('item_id',   $_POST['item_id']);
  $loan->setValor('reader_id', $_POST['reader_id']);
  $loan->delCampo('entry');
  $loan->delCampo('devolution');
  $loan->delCampo('prevision');
  $loan->valorpk = $id;
  $loan->atualizar($loan);
}

function excluir($id){
  $loan = new Loan();
  $loan->valorpk = $id;
  $loan->excluir($loan);
}

function devolver($id){
  $loan = new Loan();
  $loan->setValor('devolution', dataEUA($_POST['devolution']));
  $loan->delCampo('item_id');
  $loan->delCampo('reader_id');
  $loan->delCampo('entry');
  $loan->valorpk = $id;
  $loan->devolver($loan);
}

?>
