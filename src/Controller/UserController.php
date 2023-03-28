<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
  public function login ()
  {

  }
  public function register()
  {

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // clean $_POST data
          $admin = array_map('trim', $_POST);

          // TODO validations (length, format...)

          // if validation is ok, insert and redirection
          $userManager = new UserManager();
          $userManager->insert($admin);


          header('Location:/login');
          return null;
      }
    return $this->twig->render('User/register.html.twig');
  }
}
