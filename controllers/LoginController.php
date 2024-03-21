<?php

namespace App\controllers;

use App\models\Database;
use App\models\LoginModel;

class LoginController extends Controller
{
    protected ?LoginModel $oLoginModel = null;

    public function __construct()
    {
        $this->oLoginModel = new LoginModel();
        $this->oLoginModel->connection = new Database();
        if (isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
            $_SESSION['userid'] = '';
            $_SESSION['color'] = '';
            $_SESSION['user_name'] = '';
        }
    }

    public function login(): void
    {
        if (isset($_POST['login'])) {
            if ($_POST['vercode'] != $_SESSION['vercode']) {
                echo "<script>alert('Code de vérification incorrect')</script>";
            } else {
                $userId = $this->oLoginModel->existsUser($_POST['pseudo'], $_POST['password']);
                if ($userId > 0) {
                    $_SESSION['userid'] = $userId[0];
                    $_SESSION['user_name'] = $userId[1];

                    if ($userId[2] !== null) {
                        $_SESSION['color'] = $userId[2];
                    } else {
                        $colors = ['#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00'];
                        $_SESSION['color'] = $colors[array_rand($colors)];
                    }

                    header('location:index.php?action=chat/chitChat/1');
                }
            }
        }
        require_once(ROOT . 'assets/includes/header.php');
        require_once(ROOT . 'views/login/LoginView.php');
        require_once(ROOT . 'assets/includes/footer.php');
    }

    public function signup(): void
    {
        if (isset($_POST['signup'])) {
            if ($_POST['vercode'] != $_SESSION['vercode']) {
                echo "<script>alert('Code de vérification incorrect')</script>";
            } else {
                error_log($_POST['pseudo'].$_POST['password'].$_POST['email']);
                $userId = $this->oLoginModel->createUser($_POST['pseudo'], $_POST['password'], $_POST['email']);

                if ($userId > 0) {
                    $_SESSION['userid'] = $userId[0];
                    $_SESSION['user_name'] = $userId[1];

                    $colors = ['#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00'];
                    $_SESSION['color'] = $colors[array_rand($colors)];

                    header('location:index.php?action=chat/chitChat/1');
                }
            }
        }
        require_once(ROOT . 'assets/includes/header.php');
        require_once(ROOT . 'views/login/SignupView.php');
        require_once(ROOT . 'assets/includes/footer.php');
    }

    public function forgot()
    {
        if (isset($_POST['forgot'])) {
            if ($_POST['vercode'] != $_SESSION['vercode']) {
                echo "<script>alert('Code de vérification incorrect')</script>";
            } else {
                if (TRUE === $this->oLoginModel->retrievePassword($_POST['email'], $_POST['password'])) {
                    header('index.php?action=login/login');
                }
            }
        }
        require_once(ROOT . 'assets/includes/header.php');
        require_once(ROOT . 'views/login/ForgotPasswordView.php');
        require_once(ROOT . 'assets/includes/footer.php');
    }
}
