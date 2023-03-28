<?php

namespace App\Controller;

use App\Model\PlaceManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $search = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $itemManager = new PlaceManager();
            $itemManager->search($search);
        }
        return $this->twig->render('Home/index.html.twig');
    }
}
