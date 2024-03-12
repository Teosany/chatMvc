<?php

class loginController
{
	protected LoginModel $oLoginModel;

	public function __construct()
	{
		$this->oLoginModel = new LoginModel();
        $this->oLoginModel->connection = new Database();
	}

	public function loginIndex(): void
    {
		// On instancie le modèle "loginModel"

		if (isset($_POST['pseudo'])) {
			$userId = $this->oLoginModel->existsUser($_POST['pseudo'], $_POST['password']);

			if ($userId > 0) {
				$_SESSION['userid'] = $userId;
				$colors = ['#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00'];
				$_SESSION['color'] = $colors[array_rand($colors)];

				header('location:views/chat/chatView.php');
			}
		}
		require_once(ROOT . 'views/login/loginView.php');
	}


	public function signup()
	{
		//$oLoginModel = $this->loadModel('loginModel');

		if (isset($_POST['signup'])) {
			$userId = $this->oLoginModel->createUser();
			if ($userId > 0) {
				header('location:../chat/chatIndex/1');
			}
		}

		require_once(ROOT . 'views/login/signupView.php');
	}

	public function forgotpassword()
	{
		//$oLoginModel = $this->loadModel('loginModel');

		if (isset($_POST['forgot'])) {
			if (TRUE === $this->oLoginModel->retrievePassword()) {
				header('location:login');
			}
		}

		require_once(ROOT . 'views/login/forgotPasswordView.php');
	}
}
