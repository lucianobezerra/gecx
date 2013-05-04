<?php

function __autoload($classe) {
  require "class/{$classe}.class.php";
}

$session = new Session();
$session->start();

$author = new Author();
$author->extras_select = "where ativo";
$author->contar($author);
$qtde_authors = $author->retornaDados("array");

$reader = new Reader();
$reader->extras_select = "where ativo";
$reader->contar($reader);
$qtde_readers = $reader->retornaDados("array");

$item = new Item();
$item->extras_select = "where ativo";
$item->contar($item);
$qtde_items = $item->retornaDados("array");

$publisher = new Publisher();
$publisher->contar($publisher);
$qtde_publishers = $publisher->retornaDados("array");

$loan = new Loan();
$loan->contar($loan);
$qtde_loans = $loan->retornaDados("array");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
  </head>
  <body>
    <div id="home">
      <table width="40%">
        <tr>
          <td colspan="2">Principais Cadastros</td>
        </tr>
        <tr>
          <td style="width: 80%">Autores</td>
          <td><?=$qtde_authors[0] ?></td>
        </tr>
        <tr>
          <td style="width: 80%">Usuários</td>
          <td><?=$qtde_readers[0] ?></td>
        </tr>
        <tr>
          <td style="width: 80%">Itens</td>
          <td><?=$qtde_items[0] ?></td>
        </tr>
        <tr>
          <td style="width: 80%">Editoras</td>
          <td><?=$qtde_publishers[0] ?></td>
        </tr>
        <tr>
          <td style="width: 80%">Empréstimos</td>
          <td><?=$qtde_loans[0] ?></td>
        </tr>
      </table>
      
      <br/>
      <br/>
      <h3 style="font-size: 12pt; text-align: right">Bem Vindo, <?= ucfirst($session->getNode('username')); ?>!</h3>
    </div>
  </body>
</html>