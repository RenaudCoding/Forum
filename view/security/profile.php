<?php
    $profile = $result["data"]['profile'];
    if(isset($result["data"]['email'])) {
        $email = $result["data"]['email'];
    }


?>

<h1>Profil</h1>
<div>
    <p>Pseudo : <?= $profile->getNickname() ?></p>
    <p>Date d'inscription : <?= $profile->getRegisterDate() ?></p>
    <p>Role : <?= $profile->getRole() ?></p>
    <p>Email : <?= $profile->getEmail() ?></p>
</div>
<form action="index.php?ctrl=security&action=changeEmailPassword" method="post">
    <input type="submit" value="Changer Email" name="email"></br>
    <!-- <input type="submit" value="Changer mot de passe" name="password"></br> -->
</form>

<?php
if(isset($email)) { ?> 
    <form action="index.php?ctrl=security&action=changeEmail" method="post">
    <p>
        <label>Nouvel email :
            <input type="text" name="email1">
        </label>
    </p>
    <p>
        <label>Confirmer nouvel email :
            <input type="text" name="email2">
        </label>
    </p>
    <p>
        <input type="submit" value="Valider">
    </p>
</form>
 <?php
 } 
 ?>



<a href="index.php?ctrl=forum&action=index">Retour</a>
