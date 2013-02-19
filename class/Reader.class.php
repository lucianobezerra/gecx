<?php

require_once 'Base.class.php';

class Reader extends Base {

  public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'readers';
    $this->campos_valores = (sizeof($campos) <= 0) ? array(
        "name" => null,
        "address" => null,
        "neighborhood" => null,
        "phone1" => null,
        "phone2" => null,
        "email" => null,
        "city_id" => null,
        "state_id" => null,
        "birth" => null,
        "entry" => null,
        "ativo" => null
            ) :
            $campos;
    $this->campopk = "id";
  }

  public function listReaders() {
    $sql = "select readers.id, readers.name reader, readers.address, readers.neighborhood, readers.phone1, readers.phone2, ";
    $sql .= "readers.city_id, readers.state_id, readers.birth, readers.entry, cities.name citie, states.name state ";
    $sql .= "from readers ";
    $sql .= "inner join cities on readers.city_id = cities.id ";
    $sql .= "inner join states on readers.state_id = states.id ";
    $sql .= "where readers.ativo order by readers.name";
    $result = mysql_query($sql);
    return $result;
  }
}

?>
