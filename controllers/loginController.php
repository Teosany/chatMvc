<?php

class loginController
{
    protected LoginModel $oLoginModel;

    public function __construct()
    {
        $this->oLoginModel = new LoginModel();
        $this->oLoginModel->connection = new Database();
    }

    public function login(): void
    {
        if (isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
            $_SESSION['userid'] = '';
            $_SESSION['color'] = '';
        }
        if (isset($_POST['pseudo'])) {
            if ($_POST['vercode'] != $_SESSION['vercode']) {
                echo "<script>alert('Code de vérification incorrect')</script>";
            } else {
                $userId = $this->oLoginModel->existsUser($_POST['pseudo'], $_POST['password']);

                if ($userId > 0) {
                    $_SESSION['userid'] = $userId;
                    $colors = ['#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00'];
                    $_SESSION['color'] = $colors[array_rand($colors)];

                    header('location:views/chat/chatView.php');
                }
            }
        }
        require_once(ROOT . 'includes/header.php');
        require_once(ROOT . 'views/login/loginView.php');
        require_once(ROOT . 'includes/footer.php');
    }

    public function signup(): void
    {
        error_log('dsf');
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
