<?php
    $profile = $result["data"]['profile'];
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
    <input type="submit" value="Changer Email" name="emailForm"></br>
    <!-- <input type="submit" value="Changer mot de passe" name="password"></br> -->
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
 } 
 ?>



<a href="index.php?ctrl=forum&action=index">Retour</a>
