<?php

class Login extends Controller {
		public function index() {
				if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
						header('Location: /home');
						exit;
				}
				$this->view('login/index');
		}

		public function authenticate() {
				$username = $_POST['username'];
				$password = $_POST['password'];

				$user = $this->model('User');
				$authResult = $user->authenticate($username, $password);

				if ($authResult['status'] == 'success') {
						$_SESSION['auth'] = 1;
						$_SESSION['username'] = $username;
						header('Location: /home');
						exit;
				} else {
						$_SESSION['error'] = $authResult['message'];
						header('Location: /login');
						exit;
				}
		}
}
