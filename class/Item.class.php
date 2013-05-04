<?php

require_once 'Base.class.php';
class Item extends Base {

  public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'items';
    $this->campos_valores = (sizeof($campos) <= 0) ? array(
        "author_id" => null, 
        "category_id" => null, 
        "type_id" => null, 
        "publisher_id" => null, 
        "isbn" => null, 
        "title" => null, 
        "subtitle" => null, 
        "pages" => null, 
        "existing_copies" => null, 
        "available_copies" => null, 
        "ativo" => null) : 
      $campos;
    $this->campopk = "id";
  }
  
  public function listItems($condicao){
    $sql =  "select items.id, authors.name author, categories.description category, types.description type, ";
    $sql .= "publishers.name publisher, items.isbn, items.title, items.subtitle, items.pages, ";
    $sql .= "items.existing_copies, items.available_copies, items.ativo ";
    $sql .= "from items ";
    $sql .= "inner join authors on items.author_id = authors.id ";
    $sql .= "inner join categories on items.category_id = categories.id ";
    $sql .= "inner join types on items.type_id = types.id ";
    $sql .= "inner join publishers on items.publisher_id = publishers.id ";
    $sql .= "where items.ativo {$condicao} order by items.title";
    $result = mysql_query($sql);
    return $result;
  }
  
}

?>
