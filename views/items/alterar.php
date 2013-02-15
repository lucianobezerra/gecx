<?php

function __autoload($classe) {
  require_once "../../class/{$classe}.class.php";
}

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

$category = new Category();
$category->extras_select = "order by description";
$category->selecionaTudo($category);

$type = new Type();
$type->extras_select = "order by description";
$type->selecionaTudo($type);

$author = new Author();
$author->extras_select = "order by name";
$author->selecionaTudo($author);

$publisher = new Publisher();
$publisher->extras_select = "order by name";
$publisher->selecionaTudo($publisher);

$item = new Item();
$item->valorpk = $id;
$item->seleciona($item);

$linha = $item->retornaDados("array");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <script type="text/javascript">
      $(function($) {
        $('form#item').submit(function() {
          $(this).ajaxSubmit(function(retorno) {
            if (!retorno) {
              alert('Item Alterado.');
              $('#right').load("views/items/index.php");
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
    <p style="font-size: 12pt; margin-top: 12px;">Alteração do Item</p><br/>
    <form name="item" id="item" method="POST" action="model/item.php?acao=alterar&id=<?=$linha['id']; ?>">
      <table width="100%">
        <tr>
          <td width="20%">ISBN: </td>
          <td width="80%"><input type="number" name="isbn" id="isbn" autofocus="true" size="40" maxlength="60" class="campo" value="<?=$linha['isbn']; ?>" /></td>
        </tr>
        <tr>
          <td width="20%">Título: </td>
          <td width="80%"><input type="text" name="title" id="title" size="40" maxlength="60" class="campo" required="true" value="<?=$linha['title']; ?>"/></td>
        </tr>
        <tr>
          <td width="20%">SubTítulo: </td>
          <td width="80%"><input type="text" name="subtitle" id="subtitle" size="40" maxlength="60" class="campo" value="<?=$linha['subtitle']; ?>"/></td>
        </tr>
        <tr>
          <td>Categoria:</td>
          <td>
            <select id="category_id" name="category_id">
              <?php
              echo "<option value='0'>Selecione</option>";
              while ($categ = $category->retornaDados()) {
                $selected = $linha['category_id'] == $categ->id ? "selected='selected'" : "";
                echo "<option value={$categ->id} $selected>{$categ->description}</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Tipo de Mídia:</td>
          <td>
            <select id="type_id" name="type_id">
              <?php
              echo "<option value='0'>Selecione</option>";
              while ($typ = $type->retornaDados()) {
                $selected = $linha['type_id'] == $typ->id ? "selected='selected'" : "";
                echo "<option value={$typ->id} $selected>{$typ->description}</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Autor:</td>
          <td>
            <select id="author_id" name="author_id">
              <?php
              echo "<option value='0'>Selecione</option>";
                echo $linha['author_id'];
              while ($autor = $author->retornaDados()) {
                $selected = $linha['author_id'] == $autor->id ? "selected='selected'" : "";
                echo "<option value={$autor->id} $selected>{$autor->name}</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Editora:</td>
          <td>
            <select id="publisher_id" name="publisher_id">
              <?php
              echo "<option value='0'>Selecione</option>";
              while ($publis = $publisher->retornaDados()) {
                $selected = $linha['publisher_id'] == $publis->id ? "selected='selected'" : "";
                echo "<option value={$publis->id} $selected>{$publis->name}</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td width="20%">Páginas: </td>
          <td width="80%"><input type="number" name="pages" id="pages" class="campo" value="<?=$linha['pages'];?>" /></td>
        </tr>
        <tr>
          <td width="20%">Exemplares: </td>
          <td width="80%"><input type="number" name="existing_copies" id="existing_copies" class="campo" value="<?=$linha['existing_copies'];?>" /></td>
        </tr>
        <tr>
          <td>Ativo?</td>
          <td>
            Sim <input type="radio" name="ativo" id="ativo" value="1" class="campo" <?php echo $linha['ativo'] == '1' ? 'checked=checked' : ''; ?>/>
            Não <input type="radio" name="ativo" id="ativo" value="0" class="campo" <?php echo $linha['ativo'] == '0' ? 'checked=checked' : ''; ?>/>
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