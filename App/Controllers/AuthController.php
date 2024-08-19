<?php
// App/Controllers/AuthController.php

namespace App\Controllers;

use App\Core\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        if ($this->request->isPost()) {
            $email = $this->request->postParam('email');
            $password = $this->request->postParam('password');

            $user = $this->model->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $this->session->set('user_id', $user['id']);
                $this->session->set('user_name', $user['name']);
                $this->session->flash('success', 'Has iniciado sesión correctamente');
                $this->redirect('/dashboard');
            } else {
                $this->session->flash('error', 'Credenciales inválidas');
                $this->redirect('/login');
            }
        }

        echo $this->render('auth/login');
    }

    public function logout()
    {
        $this->session->clear();
        $this->session->flash('success', 'Has cerrado sesión correctamente');
        $this->redirect('/');
    }
}