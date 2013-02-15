<?php

function __autoload($classe) {
  require "{$classe}.class.php";
}

class Acesso extends Base {

  public function __construct($campos = array()) {
    parent::__construct();
    $this->tabela = 'users';

    if (sizeof($campos) <= 0) {
      $this->campos_valores = array("username" => null, "password" => null, "name" => null, "ativo" => null);
    } else {
      $this->campos_valores = $campos;
    }
    $this->campopk = 'id';
  }

  private function encrypt($senha) {
    return md5($senha);
  }

  public function autentica($login, $senha) {
    $senha = $this->encrypt($senha);
    $query = mysql_query("select id, username, name from {$this->tabela} where username = '{$login}' and password = '{$senha}' and ativo");
    if (mysql_num_rows($query) > 0) {
      while ($usuario = mysql_fetch_object($query)) {
        $session = new Session();
        $session->start();
        $session->addNode("userid",   $usuario->id);
        $session->addNode("username", $usuario->username);
        $session->addNode("name",     $usuario->name);
      }
      return true;
    } else
      return false;
  }

  public function getNomeOperador() {
    $session = new Session();
    return $session->getNode("name");
  }

  public function getIdOperador() {
    $session = new Session();
    return $session->getNode("userid");
  }

  public function getLoginOperador() {
    $session = new Session();
    return $session->getNode("username");
  }
}

?>