<!DOCTYPE html>
<html>
  <header>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../../stylesheet/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../../stylesheet/main.css"/>
    <script type='text/javascript' src='../../javascript/jquery-1.9.1.js'></script>
    <script type="text/javascript">
      $(function() {
        $(".cod_item").click(function() {
          var codigo = $(this).attr("codigo");
          var nome = $(this).attr("nome");
          window.opener.$("#item_id").val(codigo);
          window.opener.$("#item_name").val(nome);
          window.opener.$("#item_id").trigger('change');
          window.close();
        });
      });
    </script>
  </header>
  <body>
    <fieldset  style="border: solid 1px; padding: 5px; margin: 5px">
      <legend>Pesquisar Item</legend>
      <form name="search_item" id="search_item" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <label>
          Nome: <input type="text" name="title" size="40" />
          <input type="submit" name="submit" value="Pesquisar" style="width: 85px; height: 25px;" />
        </label>
      </form>
    </fieldset>
    <table width="98%" border="1" align="center" style="margin: 5px;font-size: 10pt;">
      <thead>
        <tr>
          <th colspan="2" style='text-align: center; font-size: 12pt'>Items Ativos</th>
        </tr>
        <tr>
          <th style="width: 10%; text-align: center">Cód</th>
          <th style="width: 90%; padding-left: 2px;">Título</th>
        </tr>
      </thead>
      <?php

      function __autoload($classe) {
        require "../../class/{$classe}.class.php";
      }

      if (isset($_POST['submit'])) {
        $title = $_POST['title'];

        $item = new Item();
        $items = $item->listItems("and items.title like '%{$title}%'");
        while ($row = mysql_fetch_array($items)) {
          ?>
          <tr>
            <td style="text-align: center">
              <a class  = "cod_item"
                 codigo = "<?= $row['id']; ?>"
                 nome   = "<?= $row['title']; ?>"
                 href   = "#"><?= str_pad($row['id'], 4, '0', STR_PAD_LEFT); ?>
              </a>

            </td>
            <td style="text-align: left"  ><?= $row['title']; ?></td>
          </tr>
        <?
        }
      }
      ?>
  </body>
</html>
