<?php

namespace App\Controllers;

use Core\View;

class Posts {

    public function index()
    {   
        View::render('posts/index.php');
    }

    public function show()
    {
        View::render('posts/show.php');
    }
}