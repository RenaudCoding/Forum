<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<h1>Liste des posts</h1>

<?php
if(isset($posts)) {
    foreach($posts as $post ){ ?>
        <p><?= $post ?></p>
        <p>par 
            <?= $post->getUser() == NULL ? "inconnu" : $post->getUser() ?>     
            le <?= $post->getPostDate() ?></p>
        <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">Supprimer</a>
    <?php }
    }
    else {
    echo "Il n'y a pas de post";
    }
?>

<h2></h2>
<form action="index.php?ctrl=forum&action=addPost&id=<?= $id ?>" method="post">
    <p>
        <h2><label for="message">Ajouter un message :</label></h2>
    </p>
    <textarea id="message" name="text" rows="4" cols="50"></textarea>
    <p>
        <input type="submit" value="Poster">
    </p>
</form>

<a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $topic->getCategory()->getId() ?>">Retour</a>
