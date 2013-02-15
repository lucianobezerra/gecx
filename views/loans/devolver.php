<?php

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$id = $_REQUEST['id'];

$loan = new Loan();
$loan->valorpk = $id;
$loan->seleciona($loan);

$linha = $loan->retornaDados();
?>
<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <fieldset style="border: 1px solid; padding-left: 5px; padding-right: 5px;">
      <legend>&nbsp;&nbsp;Devolução de Empréstimo&nbsp;&nbsp;</legend>
      <p>
        Código: <input type="text" value="<?=$linha->id; ?>"  size="5" autofocus="true" class="campo" />
      </p>
      <p>
        Item: <input type="text" name="item" size="40" disabled class="campo"/>
      </p>
      <p>
        Usuário: <input type="text" name="user" size="40" disabled class="campo"/>
      </p>
      <p>
        Data: <input type="date" name="devolution" size="10" class="campo" value="<?=date("d/m/Y"); ?>"/>
      </p>
      <p>
        <input type="submit" name="submit" value="Devolver" style="width: 85px" class="campo" />
      </p>
      <br/>
    </fieldset>
  </body>
</html>