<?php

namespace App\Controller;

class DashboardController extends AbstractController
{
    /**
     * Display dashboard page
     */
    public function index(): string
    {
        return $this->twig->render('Dashboard/index.html.twig');
    }
}
