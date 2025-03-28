<body class="container">

    <h1>Ajout d'une catégorie</h1>

    <form action="index.php?ctrl=forum&action=submitCategory" method="post">
        <div class="row g-1 align-items-center">
            <div class="col-auto">
                <label for="inputPassword6" class="col-form-label">Nom de la catégorie :</label>
                <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpBlock" name="name">
            </div>
        <div class="col-12 g-2">
            <input class="btn btn-primary" type="submit" value="Ajouter">
            </div>
    </form>
    <a href="index.php?ctrl=forum&action=index">Retour</a>

</body>





