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
                header('Location: /dashboard');
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

    /**
     * List users
     */
    public function list(): string
    {
        $userManager = new UserManager();
        $users = $userManager->selectAll('email');

        return $this->twig->render('User/list.html.twig', ['users' => $users]);
    }

    /**
     * Show informations for a specific user
     */
    public function show(int $id): string
    {
        $userManager = new UserManager();
        $user = $userManager->selectOneById($id);

        return $this->twig->render('User/show.html.twig', ['user' => $user]);
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): ?string
    {
        $userManager = new UserManager();
        $user = $userManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $user = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $userManager->update($user);

            header('Location: /user/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('User/edit.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $userManager = new UserManager();
            $userManager->delete((int)$id);

            header('Location:/user');
        }
    }
}
