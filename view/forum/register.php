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
        <label>
            <div class="tooltip">Mot de passe :
                <span class="tooltiptext">
                    Doit contenir:</br>
                    - Entre 8 et 16 caractères</br>
                    - Une majuscule</br>
                    - Une minuscule</br>
                    - Un caractère spécial</br>
                    - Un chiffre</br>
                    - Aucun espace</br>
                </span>
            </div>
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