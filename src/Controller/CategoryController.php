<?php

namespace App\Controller;

class CategoryController extends AbstractController
{
    public function museum(): string
    {
        return $this->twig->render('Item/corps.html.twig');
    }

    public function galerie(): string
    {
        return $this->twig->render('Item/_fond.html.twig');
    }

    public function foireSalon(): string
    {
        return $this->twig->render('Item/_decouverte.html.twig');
    }
}
