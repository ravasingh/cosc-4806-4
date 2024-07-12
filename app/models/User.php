<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
    }

    public function test() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function authenticate($username, $password) {
        $username = strtolower($username);

        // Special case for admin user
        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = 'Admin';
            $_SESSION['isAdmin'] = true;  // Set admin session
            header('Location: /reports');
            die;
        }

        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);

        if ($rows && password_verify($password, $rows['password'])) {
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($username);
            unset($_SESSION['failedAuth']);
            $this->logAttempt($username, 'good');
            header('Location: /home');
            die;
        } else {
            $this->logAttempt($username, 'bad');
            if (isset($_SESSION['failedAuth'])) {
                $_SESSION['failedAuth']['count']++;
                $_SESSION['failedAuth']['time'] = time();
            } else {
                $_SESSION['failedAuth'] = ['count' => 1, 'time' => time()];
            }
            header('Location: /login');
            die;
        }
    }

    public function logAttempt($username, $attempt) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO logs (username, attempt, time) VALUES (:username, :attempt, NOW());");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':attempt', $attempt);
        $statement->execute();
    }

    public function isLockedOut($username) {
        if (isset($_SESSION['failedAuth'])) {
            $failedAuth = $_SESSION['failedAuth'];
            if ($failedAuth['count'] >= 3 && (time() - $failedAuth['time']) < 60) {
                return true;
            }
        }
        return false;
    }

    public function register($username, $password) {
        $username = strtolower($username);
        $password = password_hash($password, PASSWORD_BCRYPT);
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password);");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
    }

    public function getUserWithMostReminders() {
        $db = db_connect();
        $statement = $db->prepare("SELECT username, COUNT(*) as reminder_count FROM notes JOIN users ON notes.user_id = users.id GROUP BY user_id ORDER BY reminder_count DESC LIMIT 1");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalLoginsByUsername() {
        $db = db_connect();
        $statement = $db->prepare("SELECT username, COUNT(*) as login_count FROM logs WHERE attempt = 'good' GROUP BY username");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
