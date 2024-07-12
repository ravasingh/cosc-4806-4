<?php

class Home extends Controller {

    public function index() {
        $noteModel = $this->model('Note');
        $notes = $noteModel->getAllNotes($_SESSION['user_id']);
        $this->view('home/index', ['notes' => $notes]);
    }
}