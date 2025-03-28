<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager; // ajout
use App\Session;


class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register() {
        
        if(isset($_POST['nickname'], $_POST['email'], $_POST['password1'], $_POST['password2'])) {

            //on filtre ce qui arrive en $_POST
            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            //on vérifie que les 2 mots de passe entrés sont identiques
            if($nickname && $email && $password1 == $password2) {

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

                    if (password_verify($password, $user->getPassword())) {
                       
                        SESSION::setUser($user);
                        header("Location:index.php?ctrl=forum&action=index");
                    }
                }
            }          
        }

        return [
            "view" => VIEW_DIR."forum/login.php",
            "meta_description" => "Connexion"
        ];
    }

    public function logout() {

        // supprime les variables de la session
        session_unset();
        
        return [
            "view" => VIEW_DIR."forum/login.php",
            "meta_description" => "Connexion"
        ];
    }

    public function profile() {
        
        // on récupère l'utilisateur en session
        $profile = Session::getUser();
        // on récupère la liste des topics
        $topicManager = new TopicManager();
        $topics = $topicManager->findTopicsById($profile->getId());
    
        return [
            "view" => VIEW_DIR."security/profile.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "profile" => $profile,
                "topics" => $topics
            ]
        ];
    }

    public function changeFormular() {

        $profile = Session::getUser();
 
        // formulaire suivant le changement solicité : email ou mot de passe
        foreach($_POST as $key => $value)
            switch($key) {
                case 'emailForm' : 
                    $formulaire = "email"; // formulaire email
                    break;
                case 'passwordForm' : 
                    $formulaire = "password"; // formulaire mot de pass
                    break;
            }   
        
        // on récupère la liste des topics
        $topicManager = new TopicManager();
        $topics = $topicManager->findTopicsById($profile->getId());

        //retour à la vue profile.php avec le type de formulaire à afficher
        return [
            "view" => VIEW_DIR."security/profile.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "profile" => $profile,
                "topics" => $topics,
                "formulaire" => $formulaire
            ]
        ];
    }

    public function changeEmail() {

        if(isset($_POST['email'])) {

            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            
            if($email) {
                $userManager = new UserManager();
                $userId = Session::getUser()->getId(); // on récupère l'id de l'utilisateur en session
                // on utilise la méthode updateEmail avec l'id de l'utilisateur et le nouvel email pour remplacer l'email actuellement en BDD
                $newEmail = $userManager->updateEmail($userId, $email);
                
                //on change immédiatement l'email dans les données de l'utilisateur en session
                Session::getUser()->setEmail($email);
            }
            else {
                echo "Problème de saisie";
            }
        }   
        header("Location:index.php?ctrl=security&action=profile");
    }

    public function changePassword() {

        if(isset($_POST['password1'], $_POST['password2'], $_POST['password3'])) {

            // on filtre les mots de passe arrivé en $_POST
            $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password3 = filter_input(INPUT_POST, "password3", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // regex sur les mots de passe

            $user = Session::getUser();
            // on vérifie que le "mot de passe actuel" renseigné dans le formulaire correspond au mot de passe de l'utilisateur en session stocké dans la BDD et que le nouveau mot de passe et sa confirmation sont identiques
            if (password_verify("$password1", $user->getPassword()) && $password2 == $password3) {
                
                $userManager = new UserManager();
                $userId = Session::getUser()->getId(); // on récupère l'id de l'utilisateur en session
                $passwordHash = password_hash($password2, PASSWORD_DEFAULT); // on hash le nouveau mot de passe
                
                // méthode updatePassword avec l'id de l'utilisateur et le mot de passe à changer dans la BDD (empreinte numérique) 
                $newPassword = $userManager->updatePassword($userId, $passwordHash);
                
                //on change immédiatement le mot de passe dans les données de l'utilisateur en session
                Session::getUser()->setPassword($passwordHash);
                }
            else {
                echo "Formulaire non valide !";
            }
        }
        header("Location:index.php?ctrl=security&action=profile");
    }
}