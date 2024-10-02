<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Connexion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
    
    <body>
    <?php require_once("../hautbas/header.php");?>
    <main class="connexion-main">
        <h2>Connexion</h2>
        <form method="post" action="connexions.php" class="connexion-form" >
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" required>

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" required>

            <input type="submit" value="Se connecter">
        </form>



        <p>Vous n'êtes toujours pas inscrit ?</p>
        <a href="inscription.php">Inscription</a>
    </main>
    <?php include('../hautbas/footer.php') ?>
</body>
<?php    
    
   
    // Vérification des identifiants
if(isset($_POST['login']) && isset($_POST['mdp'])) {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    

    //vérifications si les identifiants sont les bons
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ? AND mdp = ?");
    $stmt->execute([$login, $mdp]);
    $count = $stmt->rowCount();
    $user = $stmt->fetch();

    if ($count == 1) {
        // Connexion réussie
    
        $_SESSION['login'] = $login;
        $_SESSION['id_role'] = $user['id_role'];
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['id_user'] = $user['id'];
        
        if ($user['id_role'] == '2') {
            header("location: ../admin/joueur/crud.php");
        } else {
            echo "<p>Connexion réussie !</p>";
            header("Location: ../index.php");
        }
        exit();
    } else {
        echo "<p>Identifiant ou mot de passe incorrect</p>";
    }
}
?>
</html>