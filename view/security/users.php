<?php
    $users = $result["data"]['users'];
?>

<h1>Liste des utilisateurs</h1>

<table>
    <thead>
        <tr>
            <th>NOM</th>
            <th>DATE D'INSCRIPTION</th>
            <th>ROLE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($users as $user) {
        ?>
        <tr>
            <td><?= $user->getNickname() ?></td>
            <td><?= $user->getRegisterDate() ?></td>
            <td><?= $user->getRole() ?></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<a href="index.php?ctrl=forum&action=index">Retour</a>

   