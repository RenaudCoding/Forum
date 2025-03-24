<h1>Connexion</h1>

<form action="index.php?ctrl=security&action=loginValidation" method="post">
    <p>
        <label>Pseudo :
            <input type="text" name="nickname">
        </label>
    </p>
    <p>
        <label>Mot de passe :
            <input type="text" name="password">
        </label>
    </p>
    <p>
        <input type="submit" value="Se connecter">
    </p>
</form>
<a href="index.php?ctrl=forum&action=index">Retour</a>