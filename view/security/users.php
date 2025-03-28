<?php
    $users = $result["data"]['users'];
?>

<body class="container">

<h1>Liste des utilisateurs</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">NOM</th>
            <th scope="col">DATE D'INSCRIPTION</th>
            <th scope="col">ROLE</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
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

</body>