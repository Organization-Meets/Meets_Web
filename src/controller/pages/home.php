<?php

namespace src\controller\pages;

use src\util\view;

class home extends page{

    public static function getHome(){

    $content = view::renderView('pages/home', [
        'name' => 'nicolas'
    ]);

    return parent::getPage($content);

    }

}