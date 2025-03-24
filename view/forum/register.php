<h1>Inscription</h1>

<form action="index.php?ctrl=security&action=register" method="post">
    <p>
        <label>Pseudo :
            <input type="text" name="nickname">
        </label>
    </p>
    <p>
        <label>Email :
            <input type="text" name="email">
        </label>
    </p>
    <p>
        <label>Mot de passe :
            <input type="text" name="password1">
        </label>
    </p>
    <p>
        <label>Confirmer le mot de passe :
            <input type="text" name="password2">
        </label>
    </p>
    <p>
        <input type="submit" value="S'inscrire">
    </p>
</form>
<a href="index.php?ctrl=forum&action=index">Retour</a>