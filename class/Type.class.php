<?php

require_once('Base.class.php');

class Type extends Base {

  public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'types';
    $this->campos_valores = (sizeof($campos) <= 0) ? array("description" => null, "ativo" => null) : $campos;
    $this->campopk = "id";
  }
}

?>