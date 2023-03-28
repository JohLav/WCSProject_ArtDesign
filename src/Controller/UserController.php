<?php

    namespace App\Controller;

    use App\Model\UserManager;

class UserController extends AbstractController
{
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

    public function login(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);

            $userManager = new UserManager();
            $admin = $userManager->selectOneByEmail($credentials['email']);
            if ($admin && password_verify($credentials['password'], $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                header('Location: /');
                exit();
            }
        }

        return $this->twig->render('User/login.html.twig');
    }

    public function logout()
    {
        if (isset($_SESSION['admin_id'])) {
            unset($_SESSION['admin_id']);
        }

        header('Location: /');
    }
}
