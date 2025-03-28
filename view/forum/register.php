<body class="container">

    <h1>Inscription</h1>

    <form action="index.php?ctrl=security&action=register" method="post">
        <div class="row g-1 align-items-center">
            <div class="col-auto">
                <label for="inputPassword6" class="col-form-label"><strong>Pseudo :</strong></label>
                <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpBlock" name="nickname">
                </div>
        <div class="row g-1 align-items-center">
            <div class="col-auto">
                <label for="inputPassword6" class="col-form-label"><strong>Email :</strong></label>
                <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpBlock" name="email">
            </div>
        <div class="row g-1 align-items-center">
            <div class="col-auto">    
                <label for="inputPassword6" class="col-form-label"><strong>Mot de passe :</strong></label>
                <a href="" data-toggle="tooltip" title="Entre 8 et 16 caractères, une majuscule, une minuscule, un caractère spécial, un chiffre et aucun espace"><strong>?</strong></a>    
            <!-- Entre 8 et 16 caractères, une majuscule, une minuscule, un caractère spécial, un chiffre et aucun espace -->
                <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpBlock" name="password1">
            </div>
        <div class="row g-1 align-items-center">
            <div class="col-auto">   
                <label for="inputPassword6" class="col-form-label"><strong>Confirmer le mot de passe :</strong></label>
                <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpBlock" name="password2">
            </div>

        <div class="col-12 g-2">
            <input class="btn btn-primary" type="submit" value="S'inscrire">
        </div>
    </form>

    <a href="index.php?ctrl=forum&action=index">Retour</a>

</body>






