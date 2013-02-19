<?php
require_once '../../util/funcoes.php';

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

$loan = new Loan();
$loan->valorpk = $id;
$loan->seleciona($loan);

$linha = $loan->retornaDados();
?>
<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript">
      $(function() {
        $('input#id').blur(function() {
          var item_id = $('input#item_id').val();
          var user_id = $('input#user_id').val();
          $.post('views/loans/items.php', {id: item_id}, function(data) {
            $('input#item_name').attr('value', data);
          });
          $.post('views/loans/readers.php', {id: user_id}, function(data) {
            $('input#user_name').attr('value', data);
          });
        });

        $('input#id').trigger('blur');
        $('input#devolution').focus();

        $('form#devolver').submit(function() {
          $(this).ajaxSubmit(function(retorno) {
            if (!retorno) {
              alert('Item Devolvido.');
              $('#right').load("views/loans/index.php");
            } else {
              $('div#mensagem-erro').html(retorno);
            }
          });
          return false;
        });

      });
    </script>
  </head>
  <body>
    <form name="devolver" id="devolver" method="POST" action="model/loan.php?acao=devolver&id=<?= $id; ?>" style="padding-top: 12px;">
      <fieldset style="border: 1px solid; padding-left: 5px; padding-right: 5px;">
        <legend>&nbsp;&nbsp;Devolução de Empréstimo&nbsp;&nbsp;</legend>
        <table width="100%">
          <tr>
            <td style="width: 12%; padding-bottom: 3px;">Código:</td>
            <td colspan="2" style="padding-bottom: 3px;"><input type="text" name='id' id='id' value="<?= $linha->id; ?>" size="5" class="campo" /></td>
          </tr>
          <tr>
            <td style="width: 12%; padding-bottom: 3px;">Item:</td>
            <td style="width: 12%; padding-bottom: 3px;"><input type="text" name="item_id" id='item_id' size="4" disabled class="campo" value="<?= $linha->item_id; ?>" /></td>
            <td style="width: 76%; padding-bottom: 3px;"><input type="text" name="item_name" id='item_name'  size="40" disabled class="campo"/></td>
          </tr>
          <tr>
            <td style="width: 12%; padding-bottom: 3px;">Usuário:</td>
            <td style="width: 12%; padding-bottom: 3px;"><input type="text" name="user_id"   id="user_id" size="4" disabled class="campo" value="<?= $linha->reader_id; ?>" /></td>
            <td style="width: 76%; padding-bottom: 3px;"><input type="text" name="user_name" id='user_name'  size="40" disabled class="campo"/></td>
          </tr>
          <tr>
            <td style="width: 12%; padding-bottom: 3px;">Previsão:</td>
            <td colspan="2" style="padding-bottom: 3px;"><input type="text" name="prevision" size="7" disabled class="campo" value="<?= dataBR($linha->prevision); ?>" /></td>
          </tr>
          <tr>
            <td style="width: 12%; padding-bottom: 3px;">Devolução:</td>
            <td colspan="2" style="padding-bottom: 3px;"><input type="date" name="devolution" size="7" class="campo" value="<?= date("d/m/Y"); ?>"/></td>
          </tr>
          <tr>
            <td colspan="3" style="padding-bottom: 3px;"><input type="submit" name="submit" value="Devolver" style="width: 85px;  height: 25px" class="campo" /></td>
          </tr>
        </table>
      </fieldset>
    </form>
    <div id="mensagem-erro" class="mensagem-erro"></div>
  </body>
</html>