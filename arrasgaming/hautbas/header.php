<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="/arras_gaming/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <?php require_once(__DIR__ . '/../connexion/stayconnect.php'); ?>
</head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/arras_gaming/#navbarNavindex.php">Arras gaming</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/arras_gaming/index.php">Accueil <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/arras_gaming/tournois.php">Tournois</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/arras_gaming/presentation.php">Présentation</a>
                        </li>
                        <li>
                        <?php
                        session_start(); 
        
                        // Vérifie si la session contient un nom d'utilisateur
                        if(isset($_SESSION['pseudo'])) {
                            // Si un nom d'utilisateur est présent dans la session, affiche un bouton de déconnexion
                            echo '<a class="nav-link" href="/arras_gaming/connexion/deconnexion.php">Déconnexion</a>';
                        } else {
                            // Si aucun nom d'utilisateur n'est présent dans la session, affiche un bouton de connexion
                            echo '<a class="nav-link" href="/arras_gaming/connexion/connexions.php">Connexion</a>';
                        }
                        ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/arras_gaming/mentions_legales.php">Mentions légales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"><?php if(isset($_SESSION['pseudo'])) { echo $_SESSION['pseudo']; } ?></a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == '2') {
                                echo '<a class="nav-link" href="/arras_gaming/admin/joueur/crud.php">Crud</a>'; 
                        } 
                        ?>
                        </li> 

                    </ul>
                </div>
            </nav>
            <!-- script necessaire pour le togggler de la navbar -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        </header>
    </body>