<?php

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$loan = new Loan();
$pending = $loan->pendingLoans();
?>

<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript">
      $(function() {
        $('.devolver').click(function() {
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
          <th colspan="7" style='text-align: center; font-size: 12pt'>Devoluções Pendentes</th>
        </tr>
        <tr>
          <th style="width: 06%; text-align: center">Cód</th>
          <th style="width: 33%; padding-left: 2px;">Item</th>
          <th style="width: 33%; padding-left: 2px;">Usuário</th>
          <th style="width: 09%; padding-left: 2px;">Saída</th>
          <th style="width: 09%; padding-left: 2px;">Previsão</th>
          <th colspan="2" style='text-align: center; width: 10%'>Ação</th>
        </tr>
      </thead>
      <?php while ($linha = mysql_fetch_object($pending)) { ?>
        <tr id="row_<?= $linha->id; ?>">
          <td style='text-align: center; font-size: 9pt;'><?= str_pad($linha->id, 4, '0', STR_PAD_LEFT); ?></td>
          <td style='text-align: left; padding-left: 2px; font-size: 8pt;'><?= $linha->title ?></td>
          <td style='text-align: left; padding-left: 2px; font-size: 8pt;'><?= $linha->name ?></td>
          <td style='text-align:center; font-size: 8pt;'><?= $linha->saida ?></td>
          <td style='text-align:center;font-size: 8pt;'><?= $linha->previsao ?></td>
          <td style='text-align: center;'><?php echo "<a class='devolver' href='views/loans/devolver.php?id={$linha->id}' title='Devolver'><img src='imagens/alterar.gif' border='0' alt=''/></a>" ?></td>
          <td style='text-align: center;'><?php echo "<a class='excluir' href='#' onClick='excluir({$linha->id})' title='Excluir'><img src='imagens/excluir.png' border='0' alt=''/></a>" ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
