<?php

require_once('Base.class.php');

class User extends Base {

  public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'users';
    if (sizeof($campos) <= 0) {
      $this->campos_valores = array("username" => null, "name" => null, "password" => null, "ativo" => null);
    } else {
      $this->campos_valores = $campos;
    }
    $this->campopk = "id";
  }
  
  public function encrypt($senha){
    return md5($senha);
  }

}

?>
