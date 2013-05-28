<?php

require_once 'Base.class.php';

class Loan extends Base {

  public function __construct($campos = Array()) {
    parent::__construct();
    $this->tabela = 'loans';
    $this->campos_valores = (sizeof($campos) <= 0) ? 
            array(
                "item_id" => null, 
                "reader_id" => null, 
                "entry" => null, 
                "prevision" => null,
                "devolution" => null
                ) : 
      $campos;
    $this->campopk = "id";
  }

  public function devolver($objeto) {
    $sql = "update {$objeto->tabela} SET {$objeto->campos_valores} = '{$objeto->campos_valores[key($objeto->campos_valores)]}' where {$objeto->campopk}={$objeto->valorpk}";
    return $this->executaSql($sql);
  }

  public function itemsLoaneds($item_id){
    $sql = "SELECT count( item_id ) AS qtde FROM loans where item_id={$item_id}";
    $result = mysql_query($sql);
    return $result;
  }
  
  
  
  public function moreLoaneds(){
    $sql =  "select loans.item_id, items.title, types.description, count(loans.item_id) as qtde ";
    $sql .= "from loans  ";
    $sql .= "inner join items on loans.item_id = items.id ";
    $sql .= "inner join types on items.type_id = types.id ";
    $sql .= "group by loans.item_id, items.title, types.description ";
    $sql .= "order by qtde desc limit 10";
    $result = mysql_query($sql);
    return $result;
  }

  public function moreAssiduous(){
    $sql =  "select loans.reader_id, readers.name, count(loans.reader_id) as qtde ";
    $sql .= "from loans ";
    $sql .= "inner join readers on loans.reader_id = readers.id ";
    $sql .= "group by loans.reader_id, readers.name ";
    $sql .= "order by qtde desc limit 10";
    $result = mysql_query($sql);
    return $result;
  }

  
  public function pendingLoans() {
    $sql  = "SELECT loans.id, items.title, readers.name, date_format(loans.entry, '%d/%m/%Y') saida, ";
    $sql .= "   date_format(loans.prevision, '%d/%m/%Y') previsao ";
    $sql .= "FROM loans ";
    $sql .= "inner join items on loans.item_id = items.id ";
    $sql .= "inner join readers on loans.reader_id = readers.id ";
    $sql .= "where devolution is null ";
    $sql .= "LIMIT 0 , 30";
    $result = mysql_query($sql);
    return $result;
  }

}

?>
