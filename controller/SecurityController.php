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

            // regex pour le mot de passe
            $errors = [];
                if (strlen($password1) < 8 || strlen($password1) > 16) {
                    $errors[] = "Le mot de passe doit avoir entre 8 et 16 caractères";
                    }
                if (!preg_match("/\d/", $password1)) {
                    $errors[] = "Le mot de passe doit avoir au moins 1 chiffre";
                }
                if (!preg_match("/[A-Z]/", $password1)) {
                    $errors[] = "Le mot de passe doit avoir au moins une lettre majuscule";
                }
                if (!preg_match("/[a-z]/", $password1)) {
                    $errors[] = "Le mot de passe doit avoir au moins une lettre minuscule";
                }
                if (!preg_match("/\W/", $password1)) {
                    $errors[] = "Le mot de passe doit avoir au moins un caractère spécial";
                }
                if (preg_match("/\s/", $password1)) {
                    $errors[] = "Le mot de passe ne doit pas contenir d'espace";
                }

                if($errors) { // si le mot de passe ne rempli pas les critères demandés
                    foreach ($errors as $error) {
                        echo $error."</br>"; // on renvoi les erreurs
                    }
                    // die();  // arrête l'exécution du script
                    return [
                        "view" => VIEW_DIR."forum/register.php",
                        "meta_description" => "Inscription"
                        ];
                    } 
                else { // si le mot de passe est ok
                    echo "le mot de passe est OK</br>";
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
                }
            else { // si il y a un soucis de saisi (le mot de passe et sa confirmation ne correspondent pas)
                echo "Il y a un soucis avec votre saisie !";
                }
        }

        return [
            "view" => VIEW_DIR."forum/register.php",
            "meta_description" => "Inscription"
        ];   
    } 
        
    public function login() {

        if(isset($_POST['nickname'], $_POST['password'])) {

            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($nickname && $password) {

                $userManager = new UserManager();
                $user = $userManager->findUserByNickname($nickname);
                
                if ($user) {

                    if (password_verify("$password", $user->getPassword())) {
                        echo "Mot de passe OK";
                    }
                    else {
                        echo "Mot de passe incorrect";
                    }
                }
                else {
                    echo "Utilisateur inconnu";
                }
            }          
        }

        return [
            "view" => VIEW_DIR."forum/login.php",
            "meta_description" => "Connexion"
        ];
    }

    public function logout() {}
}