<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {
        
        return [
            "view" => VIEW_DIR."forum/register.php",
            "meta_description" => "Inscription"
        ];
    }

    public function login () {}

    public function logout () {}
}