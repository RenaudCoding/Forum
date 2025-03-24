<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index(){
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum"
        ];
    }
        
    public function users(){
        $this->restrictTo("ROLE_USER");

        $manager = new UserManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }

    public function addUser () {

        if(isset($_POST['nickname'], $_POST['email'], $_POST['password']))

            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $passwordVerif = password_verify($_POST['password'], $password);
        
        if($nickname && $email &&  $password) {

            $userManager = new UserManager();
            $subscribeDate = date("Y-m-d H:i:s");
            $user = $userManager->add(['nickname' => $nickname, 'password' => $password, 'email' => $email, 'subscribeDate' => $subscribeDate]);


        return [
            "view" => VIEW_DIR."forum/index.php",
            "meta_description" => "Inscription"
        ];

        }

    }
}
