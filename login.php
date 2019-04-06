<?php
//Require the config
require_once("inc/config.inc.php");

//Require entities
require_once("inc/Entities/User.class.php");

//Require Utilities
require_once("inc/Utility/Page.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserMapper.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Validation.class.php");

session_start();

$loginMessages = [];
$registerMessages = [];
//Check the login
if (!empty($_POST) )  {
    UserMapper::initialize();
    switch ($_POST['post_type']) {
        case 'register':
            $registerMessages = Validation::validate();
            if(empty($registerMessages)) {
                $newUser = new User();
                $newUser->setUsername($_POST['username']);
                $newUser->setPassword($_POST['password']);
                if(!UserMapper::registerUser($newUser)) {
                    $registerMessages[] = 'This user already exists!';
                } else {
                    $registerMessages[] = 'User created';
                }
            }
            break;
        case 'login':
            $loginMessages = Validation::validate();
            if(empty($loginMessages)) {
                $user = UserMapper::getUserbyName($_POST["username"]);
                if(!is_null($user)) {
                    if($user->verifyPassword($_POST['password'])) {
                        $_SESSION['user'] = $user;
                        header('Location: home');
                    }
                    else {
                        $loginMessages[] = 'Wrong password';
                    }
                } else {
                    $loginMessages[] = 'This username doesn`t exist';
                }
            }
            break;            
    }
}

Page::$title = "GroupProject";
Page::header();
if(!empty($loginMessages)) {
    Page::showMessages($loginMessages);
}
Page::showLogin();
if(!empty($registerMessages)) {
    Page::showMessages($registerMessages);
}
Page::showRegister();
Page::footer();

?>