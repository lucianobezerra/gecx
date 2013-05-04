<?php

abstract class Banco {

  private $host = 'localhost';
  private $user = 'root';
  private $pswd = 'mysql';
  private $banco = 'gecx';
  private $conexao = null;
  private $dataset = null;
  private $linhasafetadas = -1;

  public function __construct() {
    $this->conecta();
  }

  public function __destruct() {
    if ($this->conexao != null) {
      mysql_close($this->conexao);
    }
  }

  function conecta() {
    $this->link = @mysql_connect($this->host, $this->user, $this->pswd);
    mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');
    if (!$this->link) {
      print "Ocorreu um Erro na conexão MySQL:";
      print "<b>" . mysql_error() . "</b>";
      die();
    } elseif (!mysql_select_db($this->banco, $this->link)) {
      print "Ocorreu um Erro em selecionar o Banco:";
      print "<b>" . mysql_error() . "</b>";
      die();
    }
  }

  public function inserir($objeto) {
    $sql = "insert into {$objeto->tabela} (";
    for ($i = 0; $i < count($objeto->campos_valores); $i++) {
      $sql .= key($objeto->campos_valores);
      if ($i < (count($objeto->campos_valores) - 1)) {
        $sql .= ", ";
      } else {
        $sql .= ")";
      }
      next($objeto->campos_valores);
    }
    reset($objeto->campos_valores);
    $sql .= " values (";

    for ($i = 0; $i < count($objeto->campos_valores); $i++) {
      $sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ? $objeto->campos_valores[key($objeto->campos_valores)] : "'" . $objeto->campos_valores[key($objeto->campos_valores)] . "'";
      if ($i < (count($objeto->campos_valores) - 1)) {
        $sql .= ", ";
      } else {
        $sql .= ")";
      }
      next($objeto->campos_valores);
    }
    return $this->executaSql($sql);
  }

  public function atualizar($objeto) {
    $sql = "update {$objeto->tabela} SET ";
    for ($i = 0; $i < count($objeto->campos_valores); $i++) {
      $sql .= key($objeto->campos_valores) . "=";
      $sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ? $objeto->campos_valores[key($objeto->campos_valores)] : "'" . $objeto->campos_valores[key($objeto->campos_valores)] . "'";
      if ($i < (count($objeto->campos_valores) - 1)) {
        $sql .= ", ";
      } else {
        $sql .= " ";
      }
      next($objeto->campos_valores);
    }
    $sql .= "where {$objeto->campopk}=";
    $sql .= is_numeric($objeto->valorpk) ? $objeto->valorpk : "'" . $objeto->valorpk . "'";
    return $this->executaSql($sql);
  }

  public function desativar($objeto) {
    $sql = "update {$objeto->tabela} SET ativo=0 where {$objeto->campopk}={$objeto->valorpk}";
    return $this->executaSql($sql);
  }

  public function seleciona($objeto) {
    $sql = "select * from {$objeto->tabela} where {$objeto->campopk}={$objeto->valorpk}";
    return $this->executaSql($sql);
  }

  public function selecionaTudo($objeto) {
    $sql = "select * from {$objeto->tabela} ";
    if ($objeto->extras_select != null) {
      $sql .= " " . $objeto->extras_select . " ";
    }
    //echo $sql;
    return $this->executaSql($sql);
  }

  public function selecionaCampos($objeto) {
    $sql = "select ";
    for ($i = 0; $i < count($objeto->campos_valores); $i++) {
      $sql .= key($objeto->campos_valores);
      if ($i < (count($objeto->campos_valores) - 1)) {
        $sql .= ", ";
      } else {
        $sql .= " ";
      }
      next($objeto->campos_valores);
    }
    $sql .= " from {$objeto->tabela}";

    if ($objeto->extras_select != null) {
      $sql .= " " . $objeto->extras_select . " ";
    }
    return $this->executaSql($sql);
  }

  public function executaSql($sql = null) {
    if ($sql != null) {
      $query = mysql_query($sql) or die(mysql_error());
      $this->linhasafetadas = mysql_affected_rows();
      if (substr(trim(strtolower($sql)), 0, 6) == 'select') {
        $this->dataset = $query;
        return $query;
      } else {
        return $this->linhasafetadas;
      }
    }
  }

  public function retornaDados($tipo = null) {
    switch (strtolower($tipo)) {
      case "array" : return mysql_fetch_array($this->dataset);
        break;
      case "assoc" : return mysql_fetch_assoc($this->dataset);
        break;
      case "object": return mysql_fetch_object($this->dataset);
        break;
      default : return mysql_fetch_object($this->dataset);
        break;
    }
  }

  public function excluir($objeto) {
    $sql = "delete from {$objeto->tabela} where {$objeto->campopk} = {$objeto->valorpk}";
    return $this->executaSql($sql);
  }
  
  public function contar($objeto){
    $sql = "select count(id) from {$objeto->tabela}";
    return $result = $this->executaSql($sql);
  }

}

?>
