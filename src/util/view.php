<?php

namespace src\util;

class view{

    private static function getContent($view){

        $file = __DIR__."/../../resources/view/".$view.".html";
        return file_exists($file) ? file_get_contents($file) : "";

    }

    public static function render($content, $var = []){

        $page = self::getContent($content);
        $keys = array_keys($var);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        }, $keys);

        return str_replace($keys, array_values($var), $page);

    }

}