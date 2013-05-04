<?PHP
require_once '../../util/funcoes.php';

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$mes = $_REQUEST['mes'];
$readers = new Reader();
$readers->extras_select = "where extract(month from birth) = {$mes}";
$readers->selecionaTudo($readers);
?>
<table width="100%" border="1" align="center" style="margin-top: 8px;font-size: 10pt;">
  <thead>
    <tr>
      <th colspan="4" style='text-align: center; font-size: 12pt'>Aniversariantes</th>
    </tr>
    <tr>
      <th style="width: 40%; padding-left: 2px;">Nome</th>
      <th style="width: 15%; padding-left: 2px;">Telefone</th>
      <th style="width: 35%; padding-left: 2px;">Email</th>
      <th style="width: 10%; padding-left: 2px;">Data</th>
    </tr>
  </thead>
  <?php while ($linha = $readers->retornaDados()) { ?>
    <tr id="row_<?= $linha->id; ?>">
      <td style='text-align: left; padding-left: 2px;'><?= $linha->name ?></td>
      <td style='text-align: left; padding-left: 2px;'><?= $linha->phone1 ?></td>
      <td style='text-align: left; padding-left: 2px;'><?= $linha->email ?></td>
      <td style='text-align: left; padding-left: 2px;'><?= strftime("%d/%m", strtotime($linha->birth)) ?></td>
    </tr>
  <?php } ?>
</table>
