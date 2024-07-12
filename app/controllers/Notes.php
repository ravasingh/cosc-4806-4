<?php

class Note extends Controller {

    public function create() {
        $this->view('notes/create');
    }

    public function store() {
        $user_id = $_SESSION['user_id'];
        $subject = $_POST['subject'];

        $noteModel = $this->model('Note');
        $noteModel->createNote($user_id, $subject);

        header('Location: /home');
    }

    public function edit($id) {
        $noteModel = $this->model('Note');
        $note = $noteModel->getNoteById($id);

        $this->view('notes/edit', ['note' => $note]);
    }

    public function update($id) {
        $subject = $_POST['subject'];
        $completed = isset($_POST['completed']) ? 1 : 0;

        $noteModel = $this->model('Note');
        $noteModel->updateNote($id, $subject, $completed);

        header('Location: /home');
    }

    public function delete($id) {
        $noteModel = $this->model('Note');
        $noteModel->deleteNote($id);

        header('Location: /home');
    }
    public function getAllNotes() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM notes WHERE deleted = 0");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
