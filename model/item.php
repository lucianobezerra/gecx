<?php
require_once '../util/funcoes.php';

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
  $item = new Item();
  $items = $item->listItems("and items.title like '%{$texto}%' and items.ativo order by items.title");
  ?>
  <table width="100%" border="1" align="center" style="margin-top: 8px;font-size: 10pt; line-height: 130%">
    <thead>
      <tr>
        <th colspan="8" style='text-align: center; font-size: 12pt'>Itens Ativos</th>
      </tr>
      <tr>
        <th style="width: 06%; text-align: center">Cód</th>
        <th style="width: 33%; padding-left: 2px;">Título</th>
        <th style="width: 33%; padding-left: 2px;">Autor</th>
        <th style="width: 09%; padding-left: 2px;">Cópias</th>
        <th style="width: 09%; padding-left: 2px;">Saldo</th>
        <th colspan="3" style='text-align: center; width: 12%'>Ação</th>
      </tr>
    </thead>

    <?php while ($linha = mysql_fetch_object($items)) { ?>
      <tr id="row_<?= $linha->id; ?>">
        <td style='text-align: center; font-size: 9pt;'><?= str_pad($linha->id, 4, '0', STR_PAD_LEFT); ?></td>
        <td style='text-align: left; padding-left: 2px; font-size: 9pt;'><?= $linha->title ?></td>
        <td style='text-align: left; padding-left: 2px; font-size: 9pt;'><?= $linha->author ?></td>
        <td style='text-align:center; padding-left: 2px; font-size: 9pt;'><?= $linha->existing_copies ?></td>
        <td style='text-align:center; padding-left: 2px; font-size: 9pt;'><?= $linha->available_copies ?></td>
        <td style='text-align: center;'><?php echo "<a class='alterar' href='views/items/alterar.php?id={$linha->id}' title='Alterar'><img src='imagens/alterar.gif' border='0' alt=''/></a>" ?></td>
        <td style='text-align: center;'><?php echo "<a class='desativar' href='#' onClick='desativar({$linha->id})' title='Desativar'><img src='imagens/desativar.gif' border='0' alt=''/></a>" ?></td>
        <td style='text-align: center;'><?php echo "<a class='excluir' href='#' onClick='excluir({$linha->id})' title='Excluir'><img src='imagens/excluir.png' border='0' alt=''/></a>" ?></td>
      </tr>
    <?php } ?>
  </table>
  <?
}

function inserir() {
  $item = new Item();
  $item->setValor('category_id', $_POST['category_id']);
  $item->setValor('type_id', $_POST['type_id']);
  $item->setValor('author_id', $_POST['author_id']);
  $item->setValor('publisher_id', $_POST['publisher_id']);
  $item->setValor('isbn', $_POST['isbn']);
  $item->setValor('title', strtoupper($_POST['title']));
  $item->setValor('subtitle', strtoupper($_POST['subtitle']));
  $item->setValor('pages', $_POST['pages']);
  $item->setValor('existing_copies', $_POST['existing_copies']);
  $item->setValor('available_copies', $_POST['existing_copies']);
  $item->setValor('ativo', $_POST['ativo']);
  $item->inserir($item);
}

function alterar($id) {
  $item = new Item();
  $item->setValor('category_id', $_POST['category_id']);
  $item->setValor('type_id', $_POST['type_id']);
  $item->setValor('author_id', $_POST['author_id']);
  $item->setValor('publisher_id', $_POST['publisher_id']);
  $item->setValor('isbn', $_POST['isbn']);
  $item->setValor('title', strtoupper($_POST['title']));
  $item->setValor('subtitle', strtoupper($_POST['subtitle']));
  $item->setValor('pages', $_POST['pages']);
  $item->setValor('existing_copies', $_POST['existing_copies']);
  $item->setValor('ativo', $_POST['ativo']);
  $item->valorpk = $id;
  $item->delCampo("available_copies");
  $item->atualizar($item);
}

function excluir($id) {
  $item = new Item();
  $item->valorpk = $id;
  $item->excluir($item);
}

function desativar($id) {
  $item = new Item();
  $item->valorpk = $id;
  $item->desativar($item);
}
?>