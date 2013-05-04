<?php
require_once '../util/funcoes.php';
function __autoload($classe) {
  require "../class/{$classe}.class.php";
}

$acao =  isset($_REQUEST['acao'])  ? $_REQUEST['acao']  : null;
$id   =  isset($_REQUEST['id'])    ? $_REQUEST['id']    : null;
$texto = isset($_REQUEST['texto']) ? $_REQUEST['texto'] : null;

switch ($acao) {
  case "inserir":   inserir();      break;
  case "alterar":   alterar($id);   break;
  case "excluir":   excluir($id);   break;
  case "desativar": desativar($id); break;
  case "buscar":   buscar($texto);  break;
  case "listar":   listar();  break;
}

function buscar($texto){
  $authors = new Author();
  $authors->extras_select = "where name like '%{$texto}%' and ativo order by name";
  $authors->selecionaTudo($authors);
?>
  <script type="text/javascript">
    $(function() {
      $('.alterar').click(function() {
        $('#right').load($(this).attr('href'));
        return false;
      });
    });
  </script>
    <table width="100%" border="1" align="center" style="margin-top: 8px;font-size: 10pt;">
      <thead>
        <tr>
          <th colspan="7" style='text-align: center; font-size: 12pt'>Autores Ativos</th>
        </tr>
        <tr>
          <th style="width: 8%; text-align: center">Cód</th>
          <th style="width: 50%; padding-left: 2px;">Nome</th>
          <th style="width: 22%; padding-left: 2px;">Nascimento</th>
          <th colspan="3" style='text-align: center; width: 20%'>Ação</th>
        </tr>
      </thead>
      <?php while ($linha = $authors->retornaDados()) { ?>
        <tr id="row_<?= $linha->id; ?>">
          <td style='text-align: center;'><?= str_pad($linha->id, 4, '0', STR_PAD_LEFT) ?></td>
          <td style='text-align: left; padding-left: 2px;'><?= $linha->name ?></td>
          <td style='text-align: left; padding-left: 2px;'><?= dataBR($linha->birth) ?></td>
          <td style='text-align: center;'><?php echo "<a class='alterar' href='views/authors/alterar.php?id={$linha->id}' title='Alterar'><img src='imagens/alterar.gif' border='0' alt=''/></a>" ?></td>
          <td style='text-align: center;'><?php echo "<a class='desativar' href='#' onClick='desativar({$linha->id})' title='Desativar'><img src='imagens/desativar.gif' border='0' alt=''/></a>"    ?></td>
          <td style='text-align: center;'><?php echo "<a class='excluir' href='#' onClick='excluir({$linha->id})' title='Excluir'><img src='imagens/excluir.png' border='0' alt=''/></a>" ?></td>
        </tr>
      <?php } ?>
    </table>  
<? }

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

function listar(){
  $author = new Author();
  $author->selecionaTudo($author);
  echo "<option value=''>Selecione o Autor</option>";
  echo "<option value='0'>Todos os Autores</option>";
  while($linha = $author->RetornaDados()){
    echo "<option value='{$linha->id}'>{$linha->name}</option>";
  }
}

?>
