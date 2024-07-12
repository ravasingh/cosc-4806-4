<?php

class Login extends Controller {

		public function index() {
				$this->view('login/index');
		}

		public function verify() {
				$username = $_REQUEST['username'];
				$password = $_REQUEST['password'];

				$user = $this->model('User');

				if ($user->isLockedOut($username)) {
						$_SESSION['lockoutMessage'] = "You have been locked out due to too many failed login attempts. Please try again after 60 seconds.";
						header('Location: /login');
						die;
				}

				$user->authenticate($username, $password);
		}
}