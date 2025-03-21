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

<a href="index.php?ctrl=forum&action=index">Retour</a>
