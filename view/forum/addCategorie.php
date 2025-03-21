<h1>Ajout d'une catégorie</h1>

<form action="index.php?ctrl=forum&action=submitCategory" method="post">
    <p>
        <label>Nom de la catégorie :
            <input type="text" name="name">
        </label>
    </p>
    <p>
        <input type="submit" name="submitCategory" value="Ajouter">
    </p>
</form>
<a href="index.php?ctrl=forum&action=index">Retour</a>