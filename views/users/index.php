<?php
function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$user = new User();
$user->extras_select = "where ativo order by id";
$user->selecionaTudo($user);
?>
<html>
  <head>
    <script type="text/javascript">
      function desativar(id){
        $.post('model/user.php?acao=desativar',
        {id: +id, ajax: true},
        function(resposta){
          if(!resposta){
            $('#row_'+id).fadeOut('slow');
            $('#retorno').html('Operador Desativado!').fadeIn('slow').delay(4000).fadeOut(1000);
          } else{
            $('#retorno').html(resposta).fadeIn('slow').delay(4000).fadeOut(1000);
          }
        });
      }

      function excluir(id){
        $.post('model/user.php?acao=excluir', {id: id, ajax: true}, function(resposta){
          if(!resposta){
            $('#row_'+id).fadeOut('slow');
            $('#retorno').html('Operador Excluído').fadeIn('slow').delay(4000).fadeOut(1000);
          } else {
            $('#retorno').html(resposta).fadeIn('slow').delay(4000).fadeOut(1000);
          }
        });
      }
      
      $(function(){
        $('.novo').click(function(){
          $('#right').load($(this).attr('href'));
          return false;
        });
        
        $('.alterar').click(function(){
          $('#right').load($(this).attr('href'));
          return false;
        });

        $('input[name=submit]').click(function(){
          var url = 'model/user.php?acao=buscar';
          var texto = $('input[name=search]').val();
          $.post(url, {texto: texto}, function(data){
            $('#data').html(data);
          });
          return false;
        });
      });
    </script>
  </head>
  <body>
    <fieldset style="border: solid 1px; padding: 5px; margin-top: 12px">
      <legend>Pesquisar Operadores</legend>
      <form action="#" method="post" name="pesquisar" class="campo" style="border: none">
        <table>
          <tr>
            <td>
              <input type="text"   name="search" class="campo" size="30"/>
              <input type="submit" name="submit" class="campo" value="Pesquisar" style="width: 85px; height: 25px"/>
            </td>
          </tr>
        </table>
      </form>
    </fieldset>

    <div id="retorno" style="color: red; font-weight: bold; margin-top: 8px;"></div>
    <div id='data'>
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
            <td style='text-align: center;'><?= str_pad($linha->id, 4, '0', STR_PAD_LEFT) ?></td>
            <td><?= $linha->username ?></td>
            <td><?= $linha->name ?></td>
            <td style='text-align: center;'><?php echo "<a class='alterar' href='views/users/alterar.php?id={$linha->id}' title='Alterar'><img src='imagens/alterar.gif' border='0' alt=''/></a>" ?></td>
            <td style='text-align: center;'><?php echo "<a class='desativar' href='#' onClick='desativar({$linha->id})' title='Desativar'><img src='imagens/desativar.gif' border='0' alt=''/></a>"    ?></td>
            <td style='text-align: center;'><?php echo "<a class='excluir' href='#' onClick='excluir({$linha->id})' title='Excluir'><img src='imagens/excluir.png' border='0' alt=''/></a>" ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <br/><? echo "<a class='novo' href='views/users/cadastro.php'>Novo Operador</a>" ?>
  </body>
</html>