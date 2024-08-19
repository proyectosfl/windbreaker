<?php
// App/Controllers/UserController.php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected function initModel()
    {
        $this->model = new UserModel();
    }

    // Método para listar usuarios (sin parámetros)
    public function index()
    {
        if (!$this->hasModel()) {
            throw new \RuntimeException("Este controlador requiere un modelo.");
        }
        echo "Lista de usuarios";
        
        $users = $this->model->getAllUsers();
        echo $this->render('users/index', ['users' => $users]);
    }

    // Método para mostrar un usuario específico (con parámetro GET)
    public function show($id)
    {
        echo "Mostrando detalles del usuario con ID: " . htmlspecialchars($id);
        // Ejemplo de uso de getParam
        $format = $this->request->getParam('format', 'html');
        echo " en formato: " . $format;
    }

    // Método para crear un nuevo usuario (con parámetros POST)
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $$nombre = filter_input(INPUT_POST, 'nombre', FILTER_CALLBACK, ['options' => 'htmlspecialchars']);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            echo "Creando nuevo usuario: Nombre: " . htmlspecialchars($nombre) . ", Email: " . htmlspecialchars($email);
        } else {
            echo "Método no permitido";
        }
    }

    public function register()
    {
        if ($this->request->isPost()) {
            $userData = [
                'name' => $this->request->postParam('name'),
                'email' => $this->request->postParam('email'),
                'password' => password_hash($this->request->postParam('password'), PASSWORD_DEFAULT)
            ];

            $userId = $this->model->createUser($userData);
            if ($userId) {
                $this->redirect('/login');
            } else {
                echo $this->render('users/register', ['error' => 'Error al registrar usuario']);
            }
        } else {
            echo $this->render('users/register');
        }
    }

    // Método para buscar usuarios (con parámetros GET opcionales)
    public function search()
    {
        $term = filter_input(INPUT_GET, 'term', FILTER_CALLBACK, ['options' => 'htmlspecialchars']);
        if ($term) {
            echo "Buscando usuarios con el término: " . htmlspecialchars($term);
        } else {
            echo "Por favor, proporciona un término de búsqueda";
        }
    }

    public function apiGetAllUsers()
    {
        $users = $this->model->getAllUsers();
        $this->jsonResponse($users);
    }

    public function apiGetUser($id)
    {
        $user = $this->model->getUserById($id);
        if ($user) {
            $this->jsonResponse($user);
        } else {
            $this->jsonResponse(['error' => 'Usuario no encontrado'], 404);
        }
    }
}
