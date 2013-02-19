<?php

function __autoload($classe) {
  require "../class/{$classe}.class.php";
}

$acao = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : null;
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$texto = isset($_REQUEST['texto']) ? $_REQUEST['texto'] : null;

switch ($acao) {
  case "inserir": inserir();        break;
  case "alterar": alterar($id);     break;
  case "excluir": excluir($id);     break;
  case "desativar": desativar($id); break;
  case "buscar": buscar($texto);    break;
}

function buscar($texto) {
  $publisher = new Publisher();
  $publisher->extras_select = "where name like '%{$texto}%' and ativo order by name";
  $publisher->selecionaTudo($publisher);
  ?>
  <table width="100%" border="1" align="center" style="margin-top: 8px;font-size: 10pt; line-height: 130%">
    <thead>
      <tr>
        <th colspan="9" style='text-align: center; font-size: 12pt'>Editoras Ativas</th>
      </tr>
      <tr>
        <th style="width: 60%">Nome</th>
        <th style="width: 20%">Fone</th>
        <th colspan="3" style='text-align: center; width: 20%'>Ação</th>
      </tr>
    </thead>
    <?php while ($linha = $publisher->retornaDados()) { ?>
      <tr id="row_<?= $linha->id; ?>">
        <td style="padding-left: 2px; font-size: 9pt;"><?= $linha->name ?></td>
        <td style="padding-left: 2px; font-size: 9pt;"><?= $linha->phone ?></td>
        <td style='text-align: center;font-size: 9pt;'><?php echo "<a class='alterar' href='views/publishers/alterar.php?id={$linha->id}' title='Alterar'><img src='imagens/alterar.gif' border='0' alt=''/></a>" ?></td>
        <td style='text-align: center;'><?php echo "<a class='desativar' href='#' onClick='desativar({$linha->id})' title='Desativar'><img src='imagens/desativar.gif' border='0' alt=''/></a>" ?></td>
        <td style='text-align: center;'><?php echo "<a class='excluir' href='#' onClick='excluir({$linha->id})' title='Excluir'><img src='imagens/excluir.png' border='0' alt=''/></a>" ?></td>
      </tr>
    <?php } ?>
  </table>
  <?
}

function inserir() {
  $publisher = new Publisher();
  $publisher->setValor('name', strtoupper($_POST['name']));
  $publisher->setValor('address', strtoupper($_POST['address']));
  $publisher->setValor('neighborhood', strtoupper($_POST['neighborhood']));
  $publisher->setValor('city_id', $_POST['city_id']);
  $publisher->setValor('state_id', $_POST['state_id']);
  $publisher->setValor('phone', $_POST['phone']);
  $publisher->setValor('email', strtolower($_POST['email']));
  $publisher->setValor('ativo', $_POST['ativo']);
  $publisher->inserir($publisher);
}

function alterar($id) {
  $publisher = new Publisher();
  $publisher->setValor('name', strtoupper($_POST['name']));
  $publisher->setValor('address', strtoupper($_POST['address']));
  $publisher->setValor('neighborhood', strtoupper($_POST['neighborhood']));
  $publisher->setValor('city_id', $_POST['city_id']);
  $publisher->setValor('state_id', $_POST['state_id']);
  $publisher->setValor('phone', $_POST['phone']);
  $publisher->setValor('email', strtolower($_POST['email']));
  $publisher->setValor('ativo', $_POST['ativo']);
  $publisher->valorpk = $id;
  $publisher->atualizar($publisher);
}

function excluir($id) {
  $publisher = new Publisher();
  $publisher->valorpk = $id;
  $publisher->excluir($publisher);
}

function desativar($id) {
  $publisher = new Publisher();
  $publisher->valorpk = $id;
  $publisher->desativar($publisher);
}
?>
