<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<body class="container">

<h1>Liste des topics</h1>

<?php
if (isset($topics)) {
    foreach($topics as $topic){ 
        $closed = $topic->getClosed();
        ?>
        <p>
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() == NULL ? "inconnu" : $topic->getUser() ?> le <?=  date("d/m/Y H:i:s", strtotime($topic->getCreationDate())) ?></a>
            <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer</a>
            <?php
            if($closed == 1) {
                ?>
                <a>VERROUILLÉ</a></br>
                <?php
            }
            ?>
        </p>
    <?php }
    } 
    else {
    echo "Il n'y a pas de topic";
    }
?>

<h2>Nouveau Topic</h2>
<form action="index.php?ctrl=forum&action=addTopic&id=<?= $id ?>" method="post">
    <p>
        <label for="message">Titre :</label>
    </p>
    <input type="text" name="title">
    <p>
        <label for="message">Message :</label>
    </p>
    <textarea id="message" name="text" rows="4" cols="50"></textarea>
    <p>
        <input type="submit" value="Poster">
    </p>
</form>

<a href="index.php?ctrl=forum&action=index">Retour</a>

</body>