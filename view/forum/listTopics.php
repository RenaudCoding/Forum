<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<?php
foreach($topics as $topic ){ ?>
    <p>
        <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?> le <?= $topic->getCreationDate() ?></a>
    </p>
<?php }
?>

<p><a href="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId() ?>">Ajouter un topic</a></p>
