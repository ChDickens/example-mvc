<?php

namespace App\Controllers;

use Core\View;

class Users {

    public function index()
    {
        View::render('user/index.php');
    }
}