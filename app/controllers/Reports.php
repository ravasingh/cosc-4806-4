<?php

class Reports extends Controller {

    public function index() {
        if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
            header('Location: /home');
            exit;
        }

        $noteModel = $this->model('Note');
        $userModel = $this->model('User');

        $data = [
            'allReminders' => $noteModel->getAllNotes(),
            'mostRemindersUser' => $userModel->getUserWithMostReminders(),
            'totalLogins' => $userModel->getTotalLoginsByUsername()
        ];

        $this->view('reports/index', $data);
    }
}
