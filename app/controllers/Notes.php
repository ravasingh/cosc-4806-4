<?php


class Notes extends Controller {
    public function index() {
        $note = $this->model('Note');
        $user_id = $_SESSION['user_id']; 
        $notes = $note->get_notes($user_id);
        $this->view('notes/index', ['notes' => $notes]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['subject'];
            $user_id = $_SESSION['user_id']; 

            $note = $this->model('Note');
            if ($note->create($user_id, $subject)) {
                header('Location: /notes');
            } else {
                echo "Error creating note.";
            }
        } else {
            $this->view('notes/create');
        }
    }

    public function edit($id) {
        $note = $this->model('Note');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['subject'];
            $completed = isset($_POST['completed']) ? 1 : 0;
            if ($note->update($id, $subject, $completed)) {
                header('Location: /notes');
            } else {
                echo "Error updating note.";
            }
        } else {
            $note = $note->get_note_by_id($id);
            $this->view('notes/edit', ['note' => $note]);
        }
    }

    public function delete($id) {
        $note = $this->model('Note');
        if ($note->delete($id)) {
            header('Location: /notes');
        } else {
            echo "Error deleting note.";
        }
    }
}
?>
