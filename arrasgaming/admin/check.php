<?php
if (!isset($_SESSION['id_role'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: ../../connexion/connexions.php");
    exit();
}

// Vérifiez si l'utilisateur a un rôle d'administrateur (idRole == 2)
if ($_SESSION['id_role'] != 2) {
    // Si l'utilisateur n'est pas un admin, affichez un message d'erreur ou redirigez-le
    echo "Accès refusé. Vous n'avez pas les permissions nécessaires pour accéder à cette page.";
    exit();
}
          
