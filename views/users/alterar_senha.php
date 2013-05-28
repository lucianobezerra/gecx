<?php
function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$session = new Session();
$session->start();

$id = $session->getNode('userid');

$user = new User();
$user->valorpk = $id;
$user->seleciona($user);

$linha = $user->retornaDados("array");
?>
<script type="text/javascript">
$('#form_alterar_senha').submit(function(){
  if($('#nova_senha').val() != $('#confirme_nova_senha').val()){
    $('#mensagem-erro').html('Senhas não Conferem!');
    return false;
  } else {
    $(this).ajaxSubmit(function(retorno){
      if(!retorno){
        alert('Senha Alterada.');
        $('#right').load("views/users/index.php");
      } else{
        $('div#mensagem-erro').html(retorno);
      }
    });
    return false;
  }
});
</script>
<p style="font-size: 12pt; margin-top: 12px;">Alteração de Senha</p><br/>
<form name="form_alterar_senha" id="form_alterar_senha" method="POST" action="model/user.php?acao=troca_senha&id=<?= $linha['id'] ?>">
  <table width="100%">
    <tr>
      <td width="20%">Login: </td>
      <td width="80%"><input type="text" name="username" id="username" autofocus="true" size="15" maxlength="10" class="campo" required="true" value="<?= $linha['username']; ?>" disabled /></td>
    </tr>
    <tr>
      <td>Nova Senha:</td>
      <td><input type="password" name="nova_senha" id="nova_senha" maxlength="60" class="campo" required="true" value=""/></td>
    </tr>
    <tr>
      <td>Confirme Senha:</td>
      <td><input type="password" name="confirme_nova_senha" id="confirme_nova_senha" maxlength="60" class="campo" required="true" value=""/></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" name="submit" value="Alterar" style="width: 85px; height: 25px" class="campo" /></td>
    </tr>
  </table>
</form>
<br/>
<div id="mensagem-erro" class="mensagem-erro"></div>