<?php

require_once '../../util/funcoes.php';

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

$state = new State();
$state->extras_select = "order by name";
$state->selecionaTudo($state);

$reader = new Reader();
$reader->valorpk = $id;
$reader->seleciona($reader);

$linha = $reader->retornaDados("array");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <script type="text/javascript">
      $(function($) {
        $('select[name=state_id]').change(function() {
          var url = 'views/readers/cidades.php';
          var state = $(this).val();
          var city = <?= $linha['city_id']; ?>;
          $.post(url, {state_id: state, city_id: city}, function(resposta) {
            $('select[name=city_id]').html(resposta);
            return false;
          });
        });

        $('select[name=state_id]').trigger('change');

        $('form#reader').submit(function() {
          $(this).ajaxSubmit(function(retorno) {
            if (!retorno) {
              alert('Usuário Alterado.');
              $('#right').load("views/readers/index.php");
            } else {
              $('div#mensagem-erro').html(retorno);
            }
          });
          return false;
        });
      });
    </script>
  </head>
  <body>
    <p style="font-size: 12pt; margin-top: 12px;">Alteração de Usuários</p><br/>
    <form name="reader" id="reader" method="POST" action="model/reader.php?acao=alterar&id=<?= $id; ?>">
      <table width="100%">
        <tr>
          <td width="20%">Nome: </td>
          <td width="80%">
            <input type="text" 
                   name="name" 
                   id="name" 
                   autofocus="true" 
                   size="40" 
                   maxlength="60" 
                   class="campo" 
                   required="true" 
                   value="<?= $linha['name']; ?>"/>
          </td>
        </tr>
        <tr>
          <td>Endereço:</td>
          <td>
            <input type="text" 
                   name="address" 
                   id="address" 
                   size="40" 
                   maxlength="60" 
                   class="campo" 
                   required="true"
                   value="<?= $linha['address']; ?>"/>
          </td>
        </tr>
        <tr>
          <td>Bairro:</td>
          <td>
            <input type="text" 
                   name="neighborhood" 
                   id="neighborhood" 
                   size="40" 
                   maxlength="40" 
                   class="campo" 
                   required="true"
                   value="<?= $linha['neighborhood']; ?>"/>
          </td>
        </tr>
        <tr>
          <td>Fone1:</td>
          <td><input type="tel" 
                     name="phone1" 
                     id="phone1" 
                     size="40" 
                     maxlength="14" 
                     class="campo" 
                     required="true" 
                     pattern="[0-9]{1,2}\s[0-9]{4,5}[-][0-9]{4,5}"
                     value="<?= $linha['phone1']; ?>"/>(xx xxxx-xxxx)
          </td>
        </tr>
        <tr>
          <td>Fone2:</td>
          <td>
            <input type="tel" 
                   name="phone2" 
                   id="phone2" 
                   size="40" 
                   maxlength="14" 
                   class="campo" 
                   pattern="[0-9]{1,2}\s[0-9]{4,5}[-][0-9]{4,5}"
                   value="<?= $linha['phone2']; ?>"
                   />(xx xxxx-xxxx)
          </td>
        </tr>
        <tr>
          <td>Email:</td>
          <td>
            <input type="email" 
                   name="email" 
                   id="email" 
                   size="40" 
                   maxlength="60" 
                   class="campo"
                   value="<?= $linha['email']; ?>"/>
          </td>
        </tr>
        <tr>
          <td>Estado:</td>
          <td>
            <select id="state_id" name="state_id">
              <?php
              echo "<option value='00'>Selecione</option>";
              while ($estado = $state->retornaDados()) {
                $selected = $estado->id == $linha['state_id'] ? "selected='selected'" : "";
                echo "<option value={$estado->id} $selected>{$estado->name}</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Cidade:</td>
          <td>
            <select id="city_id" name="city_id">
              <option value="000">Aguarde</option>
            </select>
          </td>
        </tr>
        <tr>
          <td width="20%">Nascimento: </td>
          <td width="80%">
            <input type="date" 
                   name="birth" 
                   id="birth" 
                   size="40" 
                   maxlength="10" 
                   class="campo"
                   value="<?= dataBR($linha['birth']); ?>"/>
          </td>
        </tr>
        <tr>
          <td>Ativo?</td>
          <td>
            Sim <input type="radio" name="ativo" id="ativo" value="1" class="campo" checked/>
            Não <input type="radio" name="ativo" id="ativo" value="0" class="campo"/>
          </td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="submit" value="Gravar" style="width: 85px; height: 25px" class="campo" /></td>
        </tr>
      </table>
    </form>
    <br/>
    <div id="mensagem-erro" class="mensagem-erro"></div>
  </body>
</html>