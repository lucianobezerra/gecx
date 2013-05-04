<?php
function __autoload($classe) {
  require "class/{$classe}.class.php";
}

$session = new Session();
$session->start();
$logado = $session->getNode("userid");
if (!$logado) {
  @header('Location: login.html');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Biblioteca GECX</title>
    <link rel="stylesheet" type="text/css" href="stylesheet/reset.css"/>
    <link rel="stylesheet" type="text/css" href="stylesheet/main.css"/>
    <link rel="stylesheet" type="text/css" href="stylesheet/menus.css"/>
    <link rel="stylesheet" type="text/css" href="stylesheet/flick/jquery-ui-1.10.0.custom.css"/>
    <script type='text/javascript' src='javascript/jquery-1.9.1.js'></script>
    <script type='text/javascript' src='javascript/jquery-ui.js'></script>
    <script type='text/javascript' src='javascript/jquery.form.js'></script>
    <script type='text/javascript' src='javascript/jquery.maskedinput.js'></script>
    <script type='text/javascript'>
      $(function() {
        $('#right').load("home.php");
        $('dd:not(:first)').hide();
        $('dt a').click(function() {
          $("dd:visible").slideUp("slow");
          $(this).parent().next().slideDown("slow");
          return false;
        });

        $('dt#inicio a').click(function() {
          $('#right').load(this.href);
          return false;
        });

        $('dd a').click(function() {
          $('#right').load(this.href);
          return false;
        });
        $('.sair').click(function() {
          $(window.document.location).attr('href', "logout.php");
        });
      });
    </script>
  </head>
  <body>
    <div id="container">
      <div id="top"><img src="imagens/banner_topo.jpg" style="width: 800px"/></div>
      <div id="left" style="height: 420px;"><?php include_once 'menus.php';?> </div>
      <div id="right" style="overflow: auto; height: 400px"></div>
      <div id="bottom">&copy;2013 - <a style="display: inline" href="http://twitter.com/#!/lucianobezerra" target="_blank">@lucianobezerra</a>
      </div>
    </div>
  </body>
</html>