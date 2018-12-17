<?php

namespace App\Controllers;

use Core\View;

class Posts {

    public function index()
    {   
        $asd = $_POST['asd'];
        View::render('posts/index.php', [
            'asd' => $asd
        ]);
    }

    public function show($id)
    {
        View::render('posts/render.php', [
            'id' => $id,
            'title' => 'title'
        ]);
    }
}