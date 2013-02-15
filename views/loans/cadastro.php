<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript">
      $(function($) {
        $('input[name=reader_id]').change(function() {
          var url = 'views/loans/readers.php';
          var id = $(this).val();
          $.post(url, {id: id}, function(data) {
            $('input[name=name_reader]').attr('value', '');
            if (!data) {
              $('input[name=name_reader]').attr('value', 'USUÁRIO NÃO LOCALIZADO!').css('color', 'red').css('background-color', 'yellow');
            } else {
              $('input[name=name_reader]').attr('value', data);
            }
          });
        });

        $('input[name=item_id]').change(function() {
          var url = 'views/loans/items.php';
          var id = $(this).val();
          $.post(url, {id: id}, function(data) {
            if (!data) {
              $('input[name=name_item]').attr('value', 'ITEM NÃO LOCALIZADO!').css('color', 'red').css('background-color', 'yellow');
            } else {
              $('input[name=name_item]').attr('value', data);
            }
          });
        });
        
        $('form#loan').submit(function() {
          $(this).ajaxSubmit(function(retorno) {
            if (!retorno) {
              alert('Emprestimo Realizado.');
              $('#right').load("views/loans/cadastro.php");
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
    <p style="font-size: 12pt; margin-top: 6px;">Emissão de Empréstimos</p><br/>
    <form name="loan" id="loan" method="POST" action="model/loan.php?acao=inserir">
      <table width="100%" border="0">
        <tr>
          <td width="10%" style="padding-top: 6px; margin-bottom: 6px">Usuário: </td>
          <td width="12%" style="padding-top: 6px; margin-bottom: 6px"><input type="number" name="reader_id" autofocus="true" size="6" class="campo" required="true" /></td>
          <td width="78%" style="padding-top: 6px; margin-bottom: 6px"><input type="text" name="name_reader" size="50" class="campo" disabled /></td>
        </tr>
        <tr>
          <td style="padding-top: 6px; margin-bottom: 6px">Item: </td>
          <td style="padding-top: 6px; margin-bottom: 6px"><input type="number" name="item_id" size="6" class="campo" required="true" /></td>
          <td style="padding-top: 6px; margin-bottom: 6px"><input type="text" name="name_item" size="50" class="campo" disabled /></td>
        </tr>
        <tr>
          <td style="padding-top: 6px; margin-bottom: 6px">Entrega:</td>
          <td style="padding-top: 6px; margin-bottom: 6px"><input type="date" name="prevision" size="6" class="campo" required="true" /></td>
          <td style="padding-top: 6px; margin-bottom: 6px">&nbsp;(Previsão)</td>
        </tr>
        <tr>
          <td style="padding-top: 6px; margin-bottom: 6px" colspan="3"><input type="submit" name="submit" value="Gravar" style="width: 85px; height: 25px" class="campo" /></td>
        </tr>
      </table>
    </form>
    <br/>
    <div id="mensagem-erro" class="mensagem-erro"></div>
  </body>
</html>