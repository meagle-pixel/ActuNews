<?php

namespace App\Controllers;

use App\Core\View;

class PageController
{
    public function earth(): void
    {
        View::render('pages/earth');
    }

    public function planetarium(): void
    {
        View::render('pages/planetarium');
    }
}
