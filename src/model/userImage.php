<?php

namespace src\model;

class userImage
{

    public static function getImage()
    {

        $caminhoPadrao = __DIR__ . '/../../resources/images/userimages/imgpadrao'; //caminho da imagem padrao

        if (isset($_SESSION['usuario'])) {
            $foto = $_SESSION['usuario']['foto'] ?? '';

            $caminhoFoto = $foto && file_exists(__DIR__ . '/../' . $foto) ? $foto : $caminhoPadrao;

            return htmlspecialchars($caminhoFoto);

        }

    }

}