<?php
function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$category = new Category();
$category->extras_select = "where ativo order by id";
$category->selecionaTudo($category);
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript">
      function desativar(id){
        $.post('model/category.php?acao=desativar',
        {id: +id, ajax: true},
        function(resposta){
          if(!resposta){
            $('#row_'+id).fadeOut('slow');
            $('#retorno').html('Categoria Desativada!').fadeIn('slow').delay(4000).fadeOut(1000);
          } else{
            $('#retorno').html(resposta).fadeIn('slow').delay(4000).fadeOut(1000);
          }
        });
      }

      function excluir(id){
        if(confirm('Confirma exclusão da Categoria '+id+'?')){
          $.post('model/category.php?acao=excluir', {id: id, ajax: true}, function(resposta){
            if(!resposta){
              $('#row_'+id).fadeOut('slow');
              $('#retorno').html('Categoria Excluída').fadeIn('slow').delay(4000).fadeOut(1000);
            } else {
              $('#retorno').html(resposta).fadeIn('slow').delay(4000).fadeOut(1000);
            }
          });
        }
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
    <table width="100%" border="1" align="center" style="margin-top: 8px;font-size: 10pt; line-height: 130%;">
      <thead>
        <tr>
          <th colspan="7" style='text-align: center; font-size: 12pt'>Categorias Ativas</th>
        </tr>
        <tr>
          <th style="width:  8%; text-align: center">Cód</th>
          <th style="width: 70%; text-align: left; padding-left: 2px;">Descrição</th>
          <th colspan="3" style='text-align: center; width: 20%'>Ação</th>
        </tr>
      </thead>
      <?php while ($linha = $category->retornaDados()) { ?>
        <tr id="row_<?= $linha->id; ?>">
          <td style='text-align: center;'><?= str_pad($linha->id, 4, '0', STR_PAD_LEFT) ?></td>
          <td style='text-align: left; padding-left: 2px;'><?= $linha->description ?></td>
          <td style='text-align: center;'><?php echo "<a class='alterar'   href='views/categories/alterar.php?id={$linha->id}' title='Alterar'><img src='imagens/alterar.gif'     border='0' alt=''/></a>" ?></td>
          <td style='text-align: center;'><?php echo "<a class='desativar' href='#' onClick='desativar({$linha->id})'          title='Desativar'><img src='imagens/desativar.gif' border='0' alt=''/></a>" ?></td>
          <td style='text-align: center;'><?php echo "<a class='excluir'   href='#' onClick='excluir({$linha->id})'            title='Excluir'><img src='imagens/excluir.png'     border='0' alt=''/></a>" ?></td>
        </tr>
      <?php } ?>
    </table>
    <br/><? echo "<a class='nova' href='views/categories/cadastro.php'>Nova Categoria</a>" ?>
  </body>
</html>