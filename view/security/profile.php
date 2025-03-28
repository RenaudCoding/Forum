<?php
    $profile = $result["data"]['profile'];
    $topics = $result["data"]['topics'];
    if(isset($result["data"]['formulaire'])) {
        $formulaire = $result["data"]['formulaire'];
    }


?>

<h1>Profil</h1>
<div>
    <p>Pseudo : <?= $profile->getNickname() ?></p>
    <p>Date d'inscription : <?= $profile->getRegisterDate() ?></p>
    <p>Role : <?= $profile->getRole() ?></p>
    <p>Email : <?= $profile->getEmail() ?></p>
</div>
<form action="index.php?ctrl=security&action=changeFormular" method="post">
    <input type="submit" value="Changer Email" name="emailForm">
    <input type="submit" value="Changer mot de passe" name="passwordForm"></br>
</form>

<?php
if(isset($formulaire)) {  
    if($formulaire == "email") { ?>
        <!-- formulaire pour changer l'email -->
        <form action="index.php?ctrl=security&action=changeEmail" method="post">
            <p>
                <label>Nouvel email :
                    <input type="text" name="email">
                </label>
            </p>
            <p>
                <input type="submit" value="Valider">
            </p>
        </form>
    <?php
    }
    if($formulaire == "password") { ?>
        <!-- formulaire pour changer le mot de passe -->
        <form action="index.php?ctrl=security&action=changePassword" method="post">
            <p>
                <label>Mot de passe actuel :
                    <input type="text" name="password1">
                </label>
            </p>
            <p>
                <label>Nouveau mot de passe :
                    <input type="text" name="password2">
                </label>
            </p>
            <p>
                <label>Confirmer nouveau mot de passe :
                    <input type="text" name="password3">
                </label>
            </p>
            <p>
                <input type="submit" value="Valider">
            </p>
        </form>
<?php 
    }
} 
?>

<h2>Liste des topics</h2>

<?php

if (isset($topics)) {
    foreach($topics as $topic){ ?>
        <p>
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> le <?= $topic->getCreationDate() ?></a>
            <!-- <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Verrouiller</a> -->
        </p>
    <?php }
    } 
    else {
    echo "Il n'y a pas de topic";
    }
?>

<a href="index.php?ctrl=forum&action=index">Retour</a>
