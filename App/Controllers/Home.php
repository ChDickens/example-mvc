<?php

namespace App\Controllers;

use Core\View;

class Home {

    public function index()
    {
        View::render('home/index.php');
    }
}