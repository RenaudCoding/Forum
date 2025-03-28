<?php
    $profile = $result["data"]['profile'];
    if(isset($result["data"]['topics'])) {
        $topics = $result["data"]['topics'];
    }
    if(isset($result["data"]['formulaire'])) {
        $formulaire = $result["data"]['formulaire'];
    }


?>

<body class="container">


<h1>Profil</h1>

    <div>
        <p><strong>Pseudo :</strong> <?= $profile->getNickname() ?></p>
        <p><strong>Date d'inscription :</strong> <?= $profile->getRegisterDate() ?></p>
        <p><strong>Role :</strong> <?= $profile->getRole() ?></p>
        <p><strong>Email :</strong> <?= $profile->getEmail() ?></p>
    </div>
    <form action="index.php?ctrl=security&action=changeFormular" method="post">
        <input class="btn btn-primary" type="submit" value="Changer Email" name="emailForm">
        <input class="btn btn-primary" type="submit" value="Changer mot de passe" name="passwordForm"></br>
    </form>

<?php
if(isset($formulaire)) {  
    if($formulaire == "email") { ?>
        <!-- formulaire pour changer l'email -->
        <form action="index.php?ctrl=security&action=changeEmail" method="post">
            <p>
                <label><strong>Nouvel email :</strong>
                    <input type="text" name="email">
                </label>
            </p>
            <p>
                <input class="btn btn-primary" type="submit" value="Valider">
            </p>
        </form>
    <?php
    }
    if($formulaire == "password") { ?>
        <!-- formulaire pour changer le mot de passe -->
        <form action="index.php?ctrl=security&action=changePassword" method="post">
            <p>
                <label><strong>Mot de passe actuel :</strong>
                    <input type="text" name="password1">
                </label>
            </p>
            <p>
                <label><strong>Nouveau mot de passe :</strong>
                    <input type="text" name="password2">
                </label>
            </p>
            <p>
                <label><strong>Confirmer nouveau mot de passe :</strong>
                    <input type="text" name="password3">
                </label>
            </p>
            <p>
                <input class="btn btn-primary" type="submit" value="Valider">
            </p>
        </form>
<?php 
    }
} 
?>

<h2>Liste des topics</h2>

<?php

if (isset($topics)) {
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">TITRE</th>
                <th scope="col">DATE DE CREATION</th>
                <th scope="col">STATUT</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach($topics as $topic){
            ?>
            <tr>
                <td><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a></td>
                <td><?= date("d/m/Y H:i:s", strtotime($topic->getCreationDate())) ?></td>  
                <td><a><?= $topic->getClosed() ?></a></td>
                <td><a href="index.php?ctrl=forum&action=lockdownTopic&id=<?= $topic->getId() ?>">Verrouiller</a></td>    
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>    
<?php
    } 
    else {
    echo "Il n'y a pas de topic";
    }
?>

<a href="index.php?ctrl=forum&action=index">Retour</a>

</body>






