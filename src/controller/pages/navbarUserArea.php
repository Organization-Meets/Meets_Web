<?php

namespace src\controller\pages;

use src\util\view;

class navbarUserArea{

  public static function getUser(){

    $caminhoPadrao = BASE_URL . 'imagem/imgPadrao.png'; //caminho da imagem padrao

    if (isset($_SESSION['usuario'])): 
          $foto = $_SESSION['usuario']['foto'] ?? '';
          
          $caminhoFoto = $foto && file_exists(__DIR__ . '/../' . $foto)
            ? BASE_URL . $foto
            : $caminhoPadrao;
        
        htmlspecialchars($caminhoFoto)

  }


}