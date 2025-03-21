<h1>Ajout d'un topic</h1>

<form action="index.php?ctrl=forum&action=submitTopic&id=<?= $id ?>" method="post">
    <p>
        <label for="message">Titre du topic :</label>
    </p>
    <input type="text" name="name">
    <p>
        <label for="message">Message :</label>
    </p>
    <textarea id="message" name="text" rows="4" cols="50"></textarea>
    <p>
        <input type="submit" value="Poster">
    </p>
</form>
<a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $id ?>">Retour</a>