<?php

namespace Core;

class View {

    public static function render($view, $args = []) {
        
        extract($args);
        $file = "../App/Views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file не найден";
        }
    }
}