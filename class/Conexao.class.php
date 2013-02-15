<?php

class Conexao {

  private $host = "localhost";
  private $user = "root";
  private $pswd = "phi1618";
  private $banco = "gecx";
  var $link;

  function conecta() {
    $this->link = @mysql_connect($this->host, $this->user, $this->pswd);
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

  function close() {
    return @mysql_close($this->link);
  }

}

?>
