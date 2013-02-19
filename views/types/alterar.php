<?php
function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

$type = new Type();
$type->valorpk = $id;
$type->seleciona($type);

$linha = $type->retornaDados("array");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <script type="text/javascript">
      $(function($){
        $('form#type').submit(function(){
          $(this).ajaxSubmit(function(retorno){
            if(!retorno){
              alert('Tipo '+<?= $linha['id']; ?> + ' Alterado.');
              $('#right').load("views/types/index.php");
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
    <p style="font-size: 12pt; margin-top: 12px;">Edição de Categorias</p><br/>
    <form name="type" id="type" method="POST" action="model/type.php?acao=alterar&id=<?= $linha['id']; ?>">
      <table width="100%">
        <tr>
          <td width="20%">Descrição: </td>
          <td width="80%"><input type="text" name="description" id="description" autofocus="true" size="40" maxlength="10" class="campo" required="true" value="<?=$linha['description']; ?>" /></td>
        </tr>
        <tr>
          <td>Ativo?</td>
          <td>
            Sim <input type="radio" name="ativo" id="ativo" value="1" class="campo" <?php echo $linha['ativo'] == '1' ? 'checked=checked' : ''; ?>/>
            Não <input type="radio" name="ativo" id="ativo" value="0" class="campo" <?php echo $linha['ativo'] == '0' ? 'checked=checked' : ''; ?>/>
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