<?php

require_once 'Base.class.php';

class City extends Base {

  public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'cities';
    $this->campos_valores = (sizeof($campos) <= 0) ? array("state_id" => null, "name" => null) : $campos;
    $this->campopk = "id";
  }

}

?>
