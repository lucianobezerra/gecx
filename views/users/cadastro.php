<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <script type="text/javascript">
      $(function($){
        $('form#user').submit(function(){
          $(this).ajaxSubmit(function(retorno){
            if(!retorno){
              alert('Operador Cadastrado.');
              $('#right').load("views/users/index.php");
            } else{
              $('div#mensagem-erro').html(retorno);
            }
          });
          return false;
        });
      });
    </script>
  </head>
  <body>
    <p style="font-size: 12pt; margin-top: 12px;">Cadastro de Operadores</p><br/>
    <form name="user" id="user" method="POST" action="model/user.php?acao=inserir">
      <table width="100%">
        <tr>
          <td width="20%">Login: </td>
          <td width="80%"><input type="text" name="username" id="username" autofocus="true" size="40" maxlength="10" class="campo" required="true" /></td>
        </tr>
        <tr>
          <td>Nome Completo:</td>
          <td><input type="text" name="name" id="name" size="40" maxlength="60" class="campo" required="true"/></td>
        </tr>
        <tr>
          <td>Senha:</td>
          <td><input type="password" name="password" id="password" size="40" maxlength="10" class="campo" required="true"/></td>
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