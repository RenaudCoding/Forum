<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<h1>Liste des posts</h1>

<?php
foreach($posts as $post ){ ?>
    <p><?= $post ?></p>
    <p>par <?= $post->getUser() ?> le <?= $post->getPostDate() ?></p>
<?php }

?>

<p><a href="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>">Répondre</a></p>
