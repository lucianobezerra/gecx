<script type="text/javascript">
  $(function(){
    $('input[name=submit]').click(function(){
      var url = 'views/readers/pesquisa_aniversarios.php';
      var mes = $('#mes').val();
      $.post(url, {mes: mes}, function(data){
        $('#data').html(data);
      });
      return false;
    });
  });
</script>


<fieldset style="padding: 5px; border: solid 1px #2d5dcb">
  <legend>Aniversariantes do Mês</legend>
  <form method="post" action="#">
    Escolha o Mês: 
    <select id="mes">
      <option value="0"> Selecione ...</option>
      <option value="1"> Janeiro</option>
      <option value="2"> Fevereiro</option>
      <option value="3"> Março</option>
      <option value="4"> Abril</option>
      <option value="5"> Maio</option>
      <option value="6"> Junho</option>
      <option value="7"> Julho</option>
      <option value="8"> Agosto</option>
      <option value="9"> Setembro</option>
      <option value="10"> Outubro</option>
      <option value="11"> Novembro</option>
      <option value="12"> Dezembro</option>
    </select><br/><br/>
    <input type="submit" name="submit" value="Processar ...">
  </form>
</fieldset>
<div id='data'></div>