<?php
require_once '../../util/funcoes.php';
function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

$author = new Author();
$author->valorpk = $id;
$author->seleciona($author);

$linha = $author->retornaDados("array");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <script type="text/javascript">
      $(function($){
        $('form#author').submit(function(){
          $(this).ajaxSubmit(function(retorno){
            if(!retorno){
              alert('Autor '+<?=$linha['id']; ?>+' Gravado.');
              $('#right').load("views/authors/index.php");
            } else{
              $('div#mensagem-erro').html(retorno);
            }
          });
          return false;
        });
      });
    </script>
  </head>
  <body>
    <p style="font-size: 12pt; margin-top: 12px;">Cadastro de Autores</p><br/>
    <form name="author" id="author" method="POST" action="model/author.php?acao=alterar&id=<?=$linha['id']; ?>">
      <table width="100%">
        <tr>
          <td width="20%">Nome: </td>
          <td width="80%"><input type="text" name="name" id="name" autofocus="true" size="40" maxlength="60" class="campo" required="true" value="<?=$linha['name'];?>" /></td>
        </tr>
        <tr>
          <td width="20%">Nascimento: </td>
          <td width="80%"><input type="date" name="birth" id="birth" autofocus="true" size="40" maxlength="10" class="campo" required="true" value="<?=dataBR($linha['birth']);?>" /></td>
        </tr>
        <tr>
          <td>Ativo?</td>
          <td>
            Sim <input type="radio" name="ativo" id="ativo" value="1" class="campo"  <?php echo $linha['ativo'] == '1' ? 'checked=checked' : ''; ?>/>
            Não <input type="radio" name="ativo" id="ativo" value="0" class="campo"  <?php echo $linha['ativo'] == '0' ? 'checked=checked' : ''; ?>/>
          </td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="submit" value="Gravar" style="width: 85px; height: 25px" class="campo" /></td>
        </tr>
      </table>
    </form>
    <br/>
    <div id="mensagem-erro" class="mensagem-erro"></div>
  </body>
</html>