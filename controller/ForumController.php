<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        // on récupère la catégorie et les topics correspondants
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        // retour à la liste des topics
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    public function listPostsByTopic($id) {

        $postManager = new PostManager();
        $topicManager = new TopicManager();
        // on récupère le topic et les posts correspondant
        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);
        
        // retour à la liste des posts
        return [
            "view" => VIEW_DIR."forum/listPosts.php",
            "meta_description" => "Liste des posts par topic : ".$topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    public function addCategory() {
        // le formulaire d'ajout de catégorie est une vue à part
        return [
            "view" => VIEW_DIR."forum/addCategorie.php",
            "meta_description" => "Ajout d'une catégorie :"
        ];
    }

    public function submitCategory() {

        if(isset($_POST['name'])) {
            // filtrage du nouveau nom de catégorie
            $nameCategory = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if($nameCategory){

                $categoryManager = new CategoryManager();
                // ajout du nom de la nouvelle catégorie dans la table category
                $category = $categoryManager->add(["name" => $nameCategory]);
                // on récupère la liste des categories
                $categories = $categoryManager->findAll(["name", "DESC"]);

                // retour à la liste des catégories
                return [
                    "view" => VIEW_DIR."forum/listCategories.php",
                    "meta_description" => "Liste des catégories du forum",
                    "data" => [
                        "categories" => $categories
                    ]
                ];
            }         
        }
    }

    public function addTopic($id) {

        if(isset($_POST['title'], $_POST['text']))
            // filtrage du nouveau topic : titre + post
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if($title && $text) {

                $topicManager = new TopicManager();
                $postManager  = new PostManager();
                $categoryManager = new CategoryManager();

                // vérification de l'existance d'une session utilisateur
                if (isset($_SESSION['user'])) {
                    // ajout du titre du topic dans la table topic
                    $topic = $topicManager->add([
                        "user_id" => $_SESSION['user']->getId(),
                        "title" => $title,
                        "category_id" => $id
                        ]);
                    // ajout du post dans la table post
                    $post = $postManager->add([
                        "user_id" => $_SESSION['user']->getId(), 
                        "text" => $text, 
                        "topic_id" => $topic
                    ]);
                    }
                else {
                        echo "Vous ne pouver pas poster";
                }
                // on récupère la catégorie et les topics correspondants
                $category = $categoryManager->findOneById($id);
                $topics = $topicManager->findTopicsByCategory($id);              

            //retour à la liste des topics
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "meta_description" => "Liste des topics par catégorie",
                "data" => [
                    "category" => $category,
                    "topics" => $topics
                ]
            ];
        }
    }

    public function addPost($id) {

        if(isset($_POST['text'])) {
            // filtrage du nouveau post
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if($text) {

                $postManager  = new PostManager();
                $topicManager = new TopicManager();

                // vérification de l'existance d'une session utilisateur
                if (isset($_SESSION['user'])) {    
                    // ajout du post dans la table post
                    $post = $postManager->add([
                        "user_id" => $_SESSION['user']->getId(),
                        "text" => $text,
                        "topic_id" => $id
                        ]);
                }
                else {
                    echo "Vous ne pouver pas poster";
                }
                // on récupère le topic et les posts correspondants
                $posts = $postManager->findPostsByTopic($id);
                $topic = $topicManager->findOneById($id);

                return [
                    "view" => VIEW_DIR."forum/listPosts.php",
                    "meta_description" => "Liste des posts par topic : ".$topic,
                    "data" => [
                        "topic" => $topic,
                        "posts" => $posts
                    ]
                ];
            }
        }
    }

    public function deleteCategory($id) {

        $categoryManager = new CategoryManager();
        $deleteCategory = $categoryManager->delete($id);
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function deleteTopic($id) {

        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();
                
        // "DELETE ON CASCADE" à été mis en place dans la BDD, pas besoin de supprimer les posts dépendants avant de supprimer le topic
        $deleteTopic = $topicManager->delete($id);
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function deletePost($id) {


        $categoryManager = new CategoryManager();
        $postManager = new PostManager();
        $post = $postManager->findOneById($id); // on récupère les infos du post
        $postUser = $post->getUser()->getId(); // on récupère l'id de l'utilisateur correspondant au post

        // $_SESSION['user']->getId() == $postUser
        if ($_SESSION['user']->getId() == $postUser || $_SESSION['user']->getRole() == "administrateur") {
            echo "Post supprimer";
            $deletePost = $postManager->delete($id);
        }
        else {
            echo "Vous ne pouvez pas supprimer ce post";
        }

        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }



}