<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript">
      $(function($) {
        $("#prevision").mask("99/99/9999");
        $('input[name=search_user]').click(function(ev) {
          var windowSize = "width=600,height=400,scrollbars=no";
          var url = 'views/loans/browse_readers.php';
          var windowName = 'Seleciona Usuário';
          window.open(url, windowName, windowSize);
          ev.preventDefault();
          return false;
        });

        $('input[name=search_item]').click(function(ev) {
          var windowSize = "width=500,height=350,scrollbars=no";
          var url = 'views/loans/browse_items.php';
          var windowName = 'Seleciona Item';
          window.open(url, windowName, windowSize);
          ev.preventDefault();
          return false;
        });

        $('input[name=reader_id]').change(function() {
          var url = 'views/loans/readers.php';
          var id = $(this).val();
          $.post(url, {id: id}, function(data) {
            $('input[name=reader_name]').attr('value', '');
            if (!data) {
              $('input[name=reader_name]').attr('value', 'USUÁRIO NÃO LOCALIZADO!').css('color', 'red').css('background-color', 'yellow');
              $('input[name=item_id]').attr('disabled', true);
              $('input[name=prevision]').attr('disabled', true);
              $('input[name=submit]').attr('disabled', true).css('color', 'red');
            } else {
              $('input[name=reader_name]').attr('value', data);
              $('input[name=item_id]').attr('disabled', false);
              $('input[name=prevision]').attr('disabled', false);
              $('input[name=submit]').attr('disabled', false).css('color', 'green');
              $('input[name=item_id]').focus();
            }
          });
        });

        $('input[name=item_id]').change(function() {
          var url = 'views/loans/items.php';
          var id = $(this).val();
          $.post(url, {id: id}, function(data) {
            if (!data) {
              $('input[name=item_name]').attr('value', 'ITEM NÃO LOCALIZADO!').css('color', 'red').css('background-color', 'yellow');
              $('input[name=prevision]').attr('disabled', true);
              $('input[name=submit]').attr('disabled', true).css('color', 'red');
            } else {
              var item = data.split("|")[0];
              var qtde = data.split("|")[1];
              if (qtde > 0) {
                $('input[name=item_name]').attr('value', item);
                $('input[name=prevision]').attr('disabled', false);
//                $('input[name=prevision]').val(myDate);
                $('input[name=submit]').attr('disabled', false).css('color', 'green');                
                $('input[name=prevision]').focus();
              } else {
                $('input[name=item_name]').attr('value', item + ' - NÃO DISPONÍVEL').css('color', 'red');
                $('input[name=prevision]').attr('disabled', true);
                $('input[name=submit]').attr('disabled', true).css('color', 'red');
              }
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
          <td width="12%" style="padding-top: 6px; margin-bottom: 6px"><input type="number" name="reader_id"   id="reader_id" autofocus="true" size="5" class="campo" required="true" style="height: 20px"/></td>
          <td width="70%" style="padding-top: 6px; margin-bottom: 6px"><input type="text"   name="reader_name" id="reader_name" size="50" class="campo" disabled style="height: 20px" /></td>
          <td width="08%" style="padding-top: 6px; margin-bottom: 6px"><input type="submit" name="search_user" value="..." class="campo" style="width: 40px; height: 20px" /> </td>
        </tr>
        <tr>
          <td style="padding-top: 6px; margin-bottom: 6px">Item: </td>
          <td style="padding-top: 6px; margin-bottom: 6px"><input type="number" name="item_id"   id="item_id"   size="5" class="campo" required="true" /></td>
          <td style="padding-top: 6px; margin-bottom: 6px"><input type="text"   name="item_name" id="item_name" size="50" class="campo" disabled /></td>
          <td style="padding-top: 6px; margin-bottom: 6px"><input type="submit" name="search_item" value="..." class="campo" style="width: 40px; height: 20px" /> </td>
        </tr>
        <tr>
          <td style="padding-top: 6px; margin-bottom: 6px">Entrega:</td>
          <td style="padding-top: 6px; margin-bottom: 6px"><input type="date" name="prevision" id="prevision" size="6" class="campo" required="true" /></td>
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