<?php

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
  case "buscar":    buscar($texto); break;
}

function inserir(){
  $user = new User();
  $user->setValor('username', $_POST['username']);
  $user->setValor('name',     $_POST['name']);
  $user->setValor('password', $user->encrypt($_POST['password']));
  $user->setValor('ativo',    $_POST['ativo']);
  $user->delCampo("entry");
  $user->inserir($user);
}

function alterar($id){
  $user = new User();
  $user->setValor('name', $_POST['name']);
  $user->setValor('ativo', $_POST['ativo']);
  $user->valorpk = $id;
  $user->delCampo("entry");
  $user->delCampo("username");
  $user->delCampo("password");
  $user->atualizar($user);
}

function buscar($texto){
  $user = new User();
  $user->extras_select = "where username like '%{$texto}%' and ativo order by username";
  $user->selecionaTudo($user);
  ?>
  <table width="100%" border="1" align="center" style="margin-top: 8px;font-size: 10pt;">
    <thead>
      <tr>
        <th colspan="7" style='text-align: center; font-size: 12pt'>Operadores Ativos</th>
      </tr>
      <tr>
        <th style="width: 10%">Cód</th>
        <th style="width: 20%">Login</th>
        <th style="width: 50%">Nome</th>
        <th colspan="3" style='text-align: center; width: 20%'>Ação</th>
      </tr>
    </thead>
    <?php while ($linha = $user->retornaDados()) { ?>
      <tr id="row_<?= $linha->id; ?>">
        <td><?= str_pad($linha->id, 4, '0', STR_PAD_LEFT) ?></td>
        <td><?= $linha->username ?></td>
        <td><?= $linha->name ?></td>
        <td style='text-align: center;'><?php echo "<a class='alterar' href='views/users/alterar.php?id={$linha->id}' title='Alterar'><img src='imagens/alterar.gif' border='0' alt=''/></a>" ?></td>
        <td style='text-align: center;'><?php echo "<a class='desativar' href='#' onClick='desativar({$linha->id})' title='Desativar'><img src='imagens/desativar.gif' border='0' alt=''/></a>"    ?></td>
        <td style='text-align: center;'><?php echo "<a class='excluir' href='#' onClick='excluir({$linha->id})' title='Excluir'><img src='imagens/excluir.png' border='0' alt=''/></a>" ?></td>
      </tr>
    <?php } ?>
  </table>
  <?
}

function excluir($id){
  $user = new User();
  $user->valorpk = $id;
  $user->excluir($user);
}

function desativar($id){
  $user = new User();
  $user->valorpk = $id;
  $user->desativar($user);
}

?>
