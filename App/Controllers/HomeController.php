<?php
// App/Controllers/HomeController.php

namespace App\Controllers;

use App\Core\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        echo $this->render('home/index', ['title' => 'Bienvenido a nuestra aplicación']);
    }

    public function about()
    {
        echo $this->render('home/about', ['title' => 'Acerca de nosotros']);
    }

    public function contact()
    {
        if ($this->request->isPost()) {
            // Procesar el formulario de contacto
            $name = $this->request->postParam('name');
            $email = $this->request->postParam('email');
            $message = $this->request->postParam('message');
            
            // Aquí podrías enviar un email, guardar en un log, etc.
            
            $this->redirect('/contact-success');
        } else {
            echo $this->render('home/contact', ['title' => 'Contáctanos']);
        }
    }
}