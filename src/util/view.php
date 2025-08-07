<?php

namespace src\util;

class view{

    private static function getContentView($view){

        $file = __DIR__."/../../resources/view/".$view.".html";
        return file_exists($file) ? file_get_contents($file) : "";

    }

    public static function renderView($content, $var = []){

        $page = self::getContentView($content);
        $keys = array_keys($var);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        }, $keys);

        return str_replace($keys, array_values($var), $page);

    }

    private static function getContentJs($js){

        $file = __DIR__."/../../resources/js/".$js.".js";
        return file_exists($file) ? file_get_contents($file) : "";

    }

    public static function renderJs($js){

        $page = self::getContentJs($js);
        return $page;

    }

}