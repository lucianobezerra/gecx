<?php

require_once('Base.class.php');

class Category extends Base {
    public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'categories';
    if (sizeof($campos) <= 0) {
      $this->campos_valores = array("description" => null, "ativo" => null);
    } else {
      $this->campos_valores = $campos;
    }
    $this->campopk = "id";
  }

}

?>
