<body class="container">

    <h1>Connexion</h1>

    <form action="index.php?ctrl=security&action=login" method="post">
        <div class="row g-1 align-items-center">
            <div class="col-auto">
            <label for="inputPassword6" class="col-form-label"><strong>Pseudo :</strong></label>
                <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpBlock" name="nickname">
            </div>
        <div class="row g-1 align-items-center">
            <div class="col-auto">
            <label for="inputPassword6" class="col-form-label"><strong>Mot de passe :</strong></label>
                <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpBlock" name="password">
            </div>
        <div class="col-12 g-2">
            <input class="btn btn-primary" type="submit" value="Se connecter">
        </div>
    </form>

<a href="index.php">Retour</a>

</body>





