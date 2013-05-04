<script type='text/javascript'>
  $(function() {
    var opcao = '';
    $("input:radio").click(function() {
      opcao = $("input:radio:checked").val();
      switch (opcao) {
        case 'all':
          var url = 'model/item.php?acao=listar';
          $.post(url, {condicao: '1=1'}, function(data) {
            $('#data').html(data);
          });
          break;
        case 'midia':
          var url = 'model/type.php?acao=listar';
          $.post(url, function(data) {
            $('#selecao').empty().append(data);
            $('#data').html("");
          });
          break;
        case 'autor':
          var url = 'model/author.php?acao=listar';
          $.post(url, function(data) {
            $('#selecao').empty().append(data);
            $('#data').html("");
          });
          break;
        case 'editora':
          var url = 'model/publisher.php?acao=listar';
          $.post(url, function(data) {
            $('#selecao').empty().append(data);
            $('#data').html("");
          });
          break;
      }
    });

    $('input[name=submit]').click(function() {
      var campo;
      var valor = $('#selecao').val();
      switch (opcao) {
        case 'all':
          campo = '1';
          valor = '1';
          break;
        case 'midia':
          campo = 'type_id';
          break;
        case 'autor':
          campo = 'author_id';
          break;
        case 'editora':
          campo = 'publisher_id';
          break;
      }

      $.post('model/item.php?acao=listar&campo=' + campo + '&valor=' + valor, function(data) {
        $('#data').html(data);
      });
      return false;
    });
  });
</script>


<fieldset style='border: solid 1px black; padding: 5px;' id='filtro'>
  <legend>Selecione um Filtro</legend>
  <form method='post' action='#'>
    &nbsp;&nbsp;Tudo&nbsp;&nbsp;<input type='radio' name='tipo' value='all'/>
    &nbsp;&nbsp;Mídia&nbsp;&nbsp;<input type='radio' name='tipo' value='midia'/>
    &nbsp;&nbsp;Autor&nbsp;&nbsp;<input type='radio' name='tipo' value='autor'/>
    &nbsp;&nbsp;Editora&nbsp;&nbsp;<input type='radio' name='tipo' value='editora'/><br>

    <select id='selecao'>
      <option value=''>Selecione</option>
    </select>
    <br/>
    <input type='submit' name='submit' value='Listar Items'>
  </form>
</fieldset>
<div id='data'>
</div>
