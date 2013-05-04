<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheet/ajustar_saldo.css"/>
    <script type="text/javascript">
      $(function($) {
        $('input[name=id]').change(function() {
          var url = 'views/manutencao/items.php';
          var id = $(this).val();
          $.post(url, {id: id}, function(data) {
            $('input[name=item_desc]').attr('value', '');
            if (!data) {
              $('input[name=item_desc]').attr('value', 'ITEM NAO LOCALIZADO!').css('color', 'red').css('background-color', 'yellow');
            } else {
              var title = data.split("|")[0];
              $('input[name=item_desc]').attr('value', title);
            }
          });
        });

        $('input[name=submit]').click(function() {
          $.post('model/item.php?acao=saldo', {id: $('input[name=id]').val(), ajax: true}, 
          function(retorno) {
            if (!retorno) {
              $('#retorno').html("Saldo Atualizado!");
            } else {
              $('#mensagem_erro').html(retorno);
            }
          });
          return false;
        });
      });
    </script>
  </head>
  <body>
    <fieldset>
      <legend>Ajustar Saldo</legend>
      <form name="ajustar_saldo" class="campo" action="#" method="post">
        <label for="item">Item</label>
        <input type="text" name="id" size="5" maxlength="6" /><input type="text" name="item_desc" size="50" disabled /><br/>
        <input type="submit" value="Atualizar" name="submit" />
      </form>
    </fieldset>
    <div id="mensagem-erro"></div>
    <div id="retorno" class="retorno"></div>
  </body>
</html>