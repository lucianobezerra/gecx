<?php
function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$publisher = new Publisher();
$publisher->extras_select = "where ativo order by id";
$publisher->selecionaTudo($publisher);
?>
<html>
  <head>
    <script type="text/javascript">
      function desativar(id){
        $.post('model/publisher.php?acao=desativar',
        {id: +id, ajax: true},
        function(resposta){
          if(!resposta){
            $('#row_'+id).fadeOut('slow');
            $('#retorno').html('Editora Desativada!').fadeIn('slow').delay(4000).fadeOut(1000);
          } else{
            $('#retorno').html(resposta).fadeIn('slow').delay(4000).fadeOut(1000);
          }
        });
      }

      function excluir(id){
        $.post('model/publisher.php?acao=excluir', {id: id, ajax: true}, function(resposta){
          if(!resposta){
            $('#row_'+id).fadeOut('slow');
            $('#retorno').html('Editora Excluída').fadeIn('slow').delay(4000).fadeOut(1000);
          } else {
            $('#retorno').html(resposta).fadeIn('slow').delay(4000).fadeOut(1000);
          }
        });
      }
      
      $(function(){
        $('.nova').click(function(){
          $('#right').load($(this).attr('href'));
          return false;
        });
        
        $('.alterar').click(function(){
          $('#right').load($(this).attr('href'));
          return false;
        });
      });
    </script>
  </head>
  <body>
    <div id="retorno" style="color: red; font-weight: bold; margin-top: 8px;"></div>
    <table width="100%" border="1" align="center" style="margin-top: 8px;font-size: 10pt; line-height: 130%">
      <thead>
        <tr>
          <th colspan="9" style='text-align: center; font-size: 12pt'>Editoras Ativas</th>
        </tr>
        <tr>
          <th style="width: 30%">Nome</th>
          <th style="width: 20%">Fone</th>
          <th style="width: 30%">Email</th>
          <th colspan="3" style='text-align: center; width: 20%'>Ação</th>
        </tr>
      </thead>
      <?php while ($linha = $publisher->retornaDados()) { ?>
        <tr id="row_<?= $linha->id; ?>">
          <td style="padding-left: 2px;"><?= $linha->name ?></td>
          <td style="padding-left: 2px;"><?= $linha->phone ?></td>
          <td style="padding-left: 2px;"><?= $linha->email ?></td>
          <td style='text-align: center;'><?php echo "<a class='alterar' href='views/publishers/alterar.php?id={$linha->id}' title='Alterar'><img src='imagens/alterar.gif' border='0' alt=''/></a>" ?></td>
          <td style='text-align: center;'><?php echo "<a class='desativar' href='#' onClick='desativar({$linha->id})' title='Desativar'><img src='imagens/desativar.gif' border='0' alt=''/></a>"    ?></td>
          <td style='text-align: center;'><?php echo "<a class='excluir' href='#' onClick='excluir({$linha->id})' title='Excluir'><img src='imagens/excluir.png' border='0' alt=''/></a>" ?></td>
        </tr>
      <?php } ?>
    </table>
    <br/><? echo "<a class='nova' href='views/publishers/cadastro.php'>Nova Editora</a>" ?>
  </body>
</html>