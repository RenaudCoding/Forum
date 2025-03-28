<?php
    $categories = $result["data"]['categories']; 
?>

<body class="container">

<h1>Liste des catégories</h1>

<?php
foreach($categories as $category ){ ?>
    <p>
        <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a>
        <?php
        if(App\Session::isAdmin()){
            ?>
            <a href="index.php?ctrl=forum&action=deleteCategory&id=<?= $category->getId() ?>">Supprimer</a>
        <?php } ?>
    </p>
<?php }
?>
    <p>
        <a href="index.php?ctrl=forum&action=addCategory">Ajouter un catégorie</a>
    </p>  
<body>
