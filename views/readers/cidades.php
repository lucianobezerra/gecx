<?php

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$state_id = $_REQUEST['state_id'];
$city_id  = isset($_REQUEST['city_id']) ? $_REQUEST['city_id'] : null;

$city = new City();
$city->extras_select = "where state_id={$state_id}";
$city->selecionaTudo($city);

echo "<option value='0'>Selecione</option>";
while ($cidade = $city->retornaDados()) {
  $selecionado = $city_id == $cidade->id ? "selected='selected'" : "";
  echo "<option value={$cidade->id} $selecionado>{$cidade->name}</option>";
}
?>
