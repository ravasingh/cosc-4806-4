<?php

    class Note {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function create($user_id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO notes (user_id, subject) VALUES (:user_id, :subject)");
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':subject', $subject);
        return $statement->execute();
    }

    public function get_notes($user_id) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM notes WHERE user_id = :user_id AND deleted = 0");
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $subject, $completed) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE notes SET subject = :subject, completed = :completed WHERE id = :id");
        $statement->bindParam(':subject', $subject);
        $statement->bindParam(':completed', $completed);
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }

    public function delete($id) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE notes SET deleted = 1 WHERE id = :id");
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}
?>