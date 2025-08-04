<?php

namespace src\controller\pages;

use src\util\view;

class page{

    private static function getHeader(){
        
        return view::render('pages/header');

    }

    private static function getFooter(){

        return view::render('pages/footer');

    }

    public static function getPage($content){

        $header = self::getHeader();
        $footer = self::getFooter();

        return view::render('pages\page', [
            'header' =>  $header,
            'content' => $content,
            'footer' => $footer
        ]);

    }

}