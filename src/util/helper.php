<?php

namespace src\util;

class helper{

    public static function dump($x){

        echo "<pre>",
                var_dump($x),
                "</pre>";

    }

}