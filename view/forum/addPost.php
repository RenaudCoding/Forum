<?php
$id = $_GET["id"];
?>

<h1>Ajout d'un post</h1>

<form action="index.php?ctrl=forum&action=submitPost&id=<?= $id ?>" method="post">
    <p>
        <label for="message">Message :</label>
    </p>
    <textarea id="message" name="text" rows="4" cols="50"></textarea>
    <p>
        <input type="submit" value="Poster">
    </p>
</form>
<a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $id ?>">Retour</a>