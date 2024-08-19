<?php
// App/Controllers/ProductController.php

class ProductController extends BaseController
{
    public function create()
    {
        if ($this->request->isPost()) {
            // Lógica de validación y creación del producto
            if ($errors) {
                $this->session->flash('errors', $errors);
                $this->session->flash('old_input', $this->request->getAllPost());
                $this->redirect('/products/create');
            } else {
                // Crear producto
                $this->session->flash('success', 'Producto creado correctamente');
                $this->redirect('/products');
            }
        }

        $errors = $this->session->getFlash('errors', []);
        $old = $this->session->getFlash('old_input', []);
        echo $this->render('products/create', compact('errors', 'old'));
    }
}