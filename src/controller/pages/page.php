<?php

namespace src\controller\pages;

use src\util\view;

class page{

    private static function getHeader(){

        $darkmode = view::renderJs("darkmode");
        $vlibras = view::renderView("pages/vlibras");
        
        return view::renderView('pages/navbar', [
            'css' => '__DIR__./resources/css/navbar',
            'link-home' => '__DIR__./src/controller/pages/home',
            'link-buscar' => '__DIR__./src/controller/pages/buscar',
            'link-postar' => '__DIR__./src/controller/pages/postar',
            'link-perfil' => '__DIR__./src/controller/pages/perfil',
            'dark-mode' => $darkmode,
            'vlibras' => $vlibras
        ]);

    }

    private static function getFooter(){

        return view::renderView('pages/footer');

    }

    public static function getPage($content){

        $header = self::getHeader();
        $footer = self::getFooter();

        return view::renderView('pages\page', [
            'header' =>  $header,
            'content' => $content,
            'footer' => $footer
        ]);

    }

}