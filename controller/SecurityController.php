<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager; // ajout

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register() {
        
        if(isset($_POST['nickname'], $_POST['email'], $_POST['password1'], $_POST['password2'])) {

            //on filtre ce qui arrive en $_POST
            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            
            //on vérifie que les 2 mots de passe entrés sont indentiques
            if($nickname && $email &&  $password1 == $password2) {

                $userManager = new UserManager();
                $user = $userManager->add(
                    ['nickname' => $nickname, 
                    'password' => password_hash($password1, PASSWORD_DEFAULT), // on hash le mot de passe qui sera stocké comme empreinte numérique
                    'email' => $email]);

            return [
                "view" => VIEW_DIR."forum/register.php",
                "meta_description" => "Inscription"
                ];
            }
            else {
                echo "Il y a un soucis avec votre saisie !";
                }
        }

        return [
            "view" => VIEW_DIR."forum/register.php",
            "meta_description" => "Inscription"
        ];   
    } 
        
    public function login() {

        return [
            "view" => VIEW_DIR."forum/login.php",
            "meta_description" => "Connexion"
        ];
    }



    public function loginValidation() {

        if(isset($_POST['nickname'], $_POST['password']))

            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $userManager = new UserManager();
            // methode pour récupérer le password d'après le nom
            $passwordVerif = password_verify();

      
    }
     

    public function logout() {}
}