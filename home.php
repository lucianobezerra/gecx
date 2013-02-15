<?php

function __autoload($classe) {
  require "class/{$classe}.class.php";
}

$session = new Session();
$session->start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
  </head>
  <style type="text/css">
    div #home{
      width: 568px;
      height: 400px;
      background-image: url('imagens/back_home.jpg'); background-repeat: no-repeat !important;
    }
  </style>
  <body>
    <div id="home">
      <br/>
      <br/>
      <h3 style="font-size: 12pt; text-align: right">Bem Vindo, <?= ucfirst($session->getNode('username')); ?>!</h3>
    </div>
  </body>
</html>