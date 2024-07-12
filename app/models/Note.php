<?php

class Note {

    public function getAllNotes($user_id) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM notes WHERE user_id = :user_id AND deleted = 0");
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNote($user_id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO notes (user_id, subject, created_at) VALUES (:user_id, :subject, NOW())");
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':subject', $subject);
        $statement->execute();
    }

    public function getNoteById($id) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM notes WHERE id = :id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNote($id, $subject, $completed) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE notes SET subject = :subject, completed = :completed WHERE id = :id");
        $statement->bindValue(':id', $id);
        $statement->bindValue(':subject', $subject);
        $statement->bindValue(':completed', $completed);
        $statement->execute();
    }

    public function deleteNote($id) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE notes SET deleted = 1 WHERE id = :id");
        $statement->bindValue(':id', $id);
        $statement->execute();
    }
}
