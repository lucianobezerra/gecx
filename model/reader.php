<?php
require_once '../util/funcoes.php';

function __autoload($classe) {
  require "../class/{$classe}.class.php";
}

$acao = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : null;
$id   = isset($_REQUEST['id'])   ? $_REQUEST['id']   : null;
$texto = isset($_REQUEST['texto']) ? $_REQUEST['texto'] : null;

switch ($acao) {
  case "inserir":   inserir();      break;
  case "alterar":   alterar($id);   break;
  case "excluir":   excluir($id);   break;
  case "desativar": desativar($id); break;
  case "pegaNome": pegaNome($id);   break;
  case "buscar":    buscar($texto); break;
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

function buscar($texto){
  $readers = new Reader();
  $readers->extras_select = "where name like '%{$texto}%' and ativo order by name";
  $readers->selecionaTudo($readers); 
  ?>
  <table width="100%" border="1" align="center" style="margin-top: 8px;font-size: 10pt;">
    <thead>
      <tr>
        <th colspan="7" style='text-align: center; font-size: 12pt'>Usuários Ativos</th>
      </tr>
      <tr>
        <th style="width: 6%; text-align: center">Cód</th>
        <th style="width: 50%; padding-left: 2px;">Nome</th>
        <th style="width: 16%; padding-left: 2px;">Telefone</th>
        <th style="width: 16%; padding-left: 2px;">Aniversário</th>
        <th colspan="3" style='text-align: center; width: 12%'>Ação</th>
      </tr>
    </thead>
    
    <?php while($linha = $readers->retornaDados()){ ?>    
      <tr id="row_<?= $linha->id; ?>">
        <td style='text-align: center; font-size: 9pt;'><?= str_pad($linha->id, 4, '0', STR_PAD_LEFT); ?></td>
        <td style='text-align: left; padding-left: 2px; font-size: 9pt;'><?= $linha->name ?></td>
        <td style='text-align: left; padding-left: 2px; font-size: 9pt;'><?= $linha->phone1 ?></td>
        <td style='text-align: center; padding-left: 0; font-size: 9pt;'><?= dataAniversario($linha->birth)." - ".  idade(date("Y-m-d"), $linha->birth). " Anos" ?></td>
        <td style='text-align: center;'><?php echo "<a class='alterar' href='views/readers/alterar.php?id={$linha->id}' title='Alterar'><img src='imagens/alterar.gif' border='0' alt=''/></a>" ?></td>
        <td style='text-align: center;'><?php echo "<a class='desativar' href='#' onClick='desativar({$linha->id})' title='Desativar'><img src='imagens/desativar.gif' border='0' alt=''/></a>"    ?></td>
        <td style='text-align: center;'><?php echo "<a class='excluir' href='#' onClick='excluir({$linha->id})' title='Excluir'><img src='imagens/excluir.png' border='0' alt=''/></a>" ?></td>
      </tr>
    <?php } ?>
  </table><?
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
