<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Arras Game</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once('hautbas/header.php'); ?>

    <main class="container text-center my-5">
        <!-- Image principale -->
        <img src="images/arrasgaming.png" alt="Arras Gaming" class="img-fluid mb-4" style="max-width: 100%; height: auto;">

        <h1 class="mb-3">Bienvenue sur Arras Game</h1>
        <p class="lead">
            Découvrez le monde des jeux vidéo et de l'e-sport chez Arras Game. Rejoignez-nous pour une expérience immersive dans l'univers du gaming.
        </p>

        <!-- Bouton pour plus d'infos ou inscription -->
        <div class="mt-5">
            <a href="presentation.php" class="btn btn-secondary btn-lg">En savoir plus</a>
            <a href="connexion/inscription.php" class="btn btn-primary btn-lg">Rejoignez-nous</a>
        </div>
    </main>

    <?php require_once('hautbas/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
