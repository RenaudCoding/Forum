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

<form action="index.php?ctrl=forum&action=addPost&id=<?= $id ?>" method="post">
    <p>
        <label for="message">Message :</label>
    </p>
    <textarea id="message" name="text" rows="4" cols="50"></textarea>
    <p>
        <input type="submit" value="Poster">
    </p>
</form>

<a href="index.php?ctrl=forum&action=listPostsByTopic">Retour</a>
