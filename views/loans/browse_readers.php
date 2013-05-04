<!DOCTYPE html>
<html>
  <header>
    <link rel="stylesheet" type="text/css" href="../../stylesheet/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../../stylesheet/main.css"/>
    <script type='text/javascript' src='../../javascript/jquery-1.9.1.js'></script>
    <script type="text/javascript">
      $(function() {
        $(".cod_user").click(function() {
          var codigo = $(this).attr("codigo");
          var nome = $(this).attr("nome");
          window.opener.$("#reader_id").val(codigo);
          window.opener.$("#reader_name").val(nome);
          window.opener.$("#reader_id").trigger('change');
          window.close();
        });
      });
    </script>
  </header>
  <body>
    <fieldset  style="border: solid 1px; padding: 5px; margin: 5px">
      <legend>Pesquisar Usuário</legend>
      <form name="search_user" id="search_user" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <label>
          Nome: <input type="text" name="name" id="name" size="40" class="campo" />
          <input type="submit" name="submit" value="Pesquisar" style="width: 85px; height: 25px;" />
        </label>
      </form>
    </fieldset>
    <table width="98%" border="1" align="center" style="margin: 5px;font-size: 10pt;">
      <thead>
        <tr>
          <th colspan="3" style='text-align: center; font-size: 12pt'>Usuários Ativos</th>
        </tr>
        <tr>
          <th style="width: 6%; text-align: center">Cód</th>
          <th style="width: 50%; padding-left: 2px;">Nome</th>
          <th style="width: 16%; padding-left: 2px;">Telefone</th>
        </tr>
      </thead>
      <?php

      function __autoload($classe) {
        require "../../class/{$classe}.class.php";
      }

      if (isset($_POST['submit'])) {
        $name = $_POST['name'];

        $reader = new Reader();
        $readers = $reader->listReaders("and readers.name like '%{$name}%'");
        while ($row = mysql_fetch_array($readers)) {
          ?>
          <tr>
            <td style="text-align: center">
              <a class  = "cod_user" 
                 codigo = "<?= $row['id']; ?>"
                 nome   = "<?= $row['reader']; ?>"
                 href   = "#"><?= str_pad($row['id'], 4, '0', STR_PAD_LEFT); ?>
              </a>

            </td>
            <td style="text-align: left"  ><?= $row['reader']; ?></td>
            <td style="text-align: center"><?= $row['phone1']; ?></td>
          </tr>
        <?
        }
      }
      ?>
  </body>
</html>
