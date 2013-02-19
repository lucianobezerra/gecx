<?php
require_once 'Base.class.php';

class Publisher extends Base{
  
  public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'publishers';
    $this->campos_valores = (sizeof($campos) <= 0) 
            ? array(
                "name" => null,	
                "address" => NULL, 
                "neighborhood" => null, 
                "city_id" => null, 
                "state_id" => null, 
                "email" => null, 
                "phone" => null, 
                "ativo" => null
                )
            : $campos;
    $this->campopk = "id";    
  }
}

?>
