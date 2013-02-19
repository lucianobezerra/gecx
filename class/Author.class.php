<?php

require_once 'Base.class.php';

class Author extends Base {

  public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'authors';
    $this->campos_valores = (sizeof($campos) <= 0) ? array("name" => null, "birth" => null) : $campos;
    $this->campopk = "id";
  }

  public function listItems($condicao){
    $sql =  "select * from authors where ativo {$condicao} ";
    $result = mysql_query($sql);
    return $result;
  }  

}

?>
