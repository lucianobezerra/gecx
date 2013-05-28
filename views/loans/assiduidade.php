<?php
require_once '../../util/funcoes.php';

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$loan = new Loan();
$loans = $loan->moreAssiduous();
?>
<table width="100%" border="1" align="center" style="margin-top: 8px;font-size: 10pt;">
  <thead>
    <tr>
      <th colspan="3" style='text-align: center; font-size: 12pt'>Leitores mais Assíduos</th>
    </tr>
    <tr>
      <th style="width: 10%">Cód</th>
      <th style="width: 60%">Título</th>
      <th style="width: 10%">Qtde</th>
    </tr>
  </thead>
  <?php while ($linha = mysql_fetch_object($loans)) { ?>
    <tr id="row_<?= $linha->reader_id; ?>">
      <td style='text-align: center;'><?= str_pad($linha->reader_id, 4, '0', STR_PAD_LEFT) ?></td>
      <td><?= $linha->name ?></td>
      <td style='text-align: center;'><?= $linha->qtde ?></td>
    </tr>
  <?php } ?>
</table>