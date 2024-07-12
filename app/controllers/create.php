<?php

class Create extends Controller {

    public function index() {		
        $this->view('create/index');
    }

    public function register() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model('User');
        $user->register($username, $password);

        header('Location: /login');
        die;
    }
}
