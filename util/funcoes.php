<?php

function idade($nascimento, $data){
  $nascimento = strtotime($nascimento." 00:00:00");
  $data = strtotime($data." 00:00:00");
  $idade = floor(abs($data - $nascimento)/60/60/24/365);
  return $idade;
}

function dataBR($data) {
  if ((isset($data)) and ($data <> '')) {
    $data = explode("-", $data);
    return "{$data[2]}/{$data[1]}/{$data[0]}";
  } else {
    return NULL;
  }
}

function dataEUA($data) {
  if ((isset($data)) and ($data <> '')) {
    $dia = substr($data, 0, 2);
    $mes = substr($data, 3, 2);
    $ano = substr($data, 6, 4);
    return "{$ano}-{$mes}-{$dia}";
  } else {
    return NULL;
  }
}

function dataAniversario($data) {
  if ((isset($data)) and ($data <> '')) {
    $data = explode("-", $data);
    return "{$data[2]}/{$data[1]}";
  } else {
    return NULL;
  }
}

?>
