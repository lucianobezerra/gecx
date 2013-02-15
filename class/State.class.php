<?php

require_once 'Base.class.php';

class State extends Base {

  public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'states';
    $this->campos_valores = (sizeof($campos) <= 0) ? array("name" => null, "acronym" => null) : $campos;
    $this->campopk = "id";
  }

}

?>
