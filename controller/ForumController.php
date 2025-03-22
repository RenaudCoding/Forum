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
                $postDate = date("Y-m-d H:i:s"); // la date du nouveau topic
                // ajout du titre du topic dans la table topic
                $topic = $topicManager->add(["title" => $title, "creationDate" => $postDate, "category_id" => $id]);
                // ajout du post dans la table post
                $post = $postManager->add(["text" => $text, "postDate" => $postDate, "topic_id" => $topic]);
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
                $postDate = date("Y-m-d H:i:s"); // la date du nouveau post
                // ajout du post dans la table post
                $post = $postManager->add(["text" => $text, "postDate" => $postDate, "topic_id" => $id]);
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
}