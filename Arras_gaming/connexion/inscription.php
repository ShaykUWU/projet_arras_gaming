<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Inscription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once('../hautbas/header.php'); ?>
    <main class="connexion-main">
    <h1> Rejoigner arras game  </h1>

    <form method="post" action="" class="connexion-form"    >
    
    <label for="login">Login :</label>
    <input type="text"  name="login" required>

    <label for="mdp">Mot de passe :</label>
    <input type="password"  name="mdp" required>

    <label for="mail">Adresse mail :</label>
    <input type="text"  name="mail" required>
    
    <label for="pseudo">Pseudo :</label>
    <input type="text"  name="pseudo" required>

    <input type="submit"  name="submit" value="S'inscrire">
</form>
<?php 

if (isset($_POST['submit'])) {
        // Escape special characters in string for use in SQL statement	
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $mail = $_POST['mail'];
        $pseudo = $_POST['pseudo'];
        //check email 
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            echo "L'adresse e-mail est valide.";
        } else {
            
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        }
        // Check for empty fields
        if (empty($login) || empty($mdp) || empty($pseudo)) {
            if (empty($login)) {
                echo "<font color='red'>Le champ login est vide.</font><br/>";
            }
            if (empty($mdp)) {
                echo "<font color='red'>Le champ mot de passe est vide.</font><br/>";
            }
            if (empty($pseudo)) {
                echo "<font color='red'>Le champ pseudo est vide.</font><br/>";
            }
            echo "<br/><a href='javascript:self.history.back();'>Retour</a>";
        } else {
            // Vérification si le login ou le pseudo existe déjà dans la base de données
            $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ? OR pseudo = ?");
            $stmt->execute([$login, $pseudo]);
            $userExists = $stmt->fetch();
    
            if ($userExists) {
                // Si un utilisateur avec le même login ou pseudo existe déjà
                if ($userExists['login'] == $login) {
                    echo "<font color='red'>Le login est déjà utilisé.</font><br/>";
                }
                if ($userExists['pseudo'] == $pseudo) {
                    echo "<font color='red'>Le pseudo est déjà utilisé.</font><br/>";
                }
                echo "<br/><a href='javascript:self.history.back();'>Retour</a>";
            } else {
                // Si le login et le pseudo sont uniques, insertion dans la base de données
                $stmt = $pdo->prepare("INSERT INTO utilisateurs (`login`, `mdp`, `mail`, `pseudo`) VALUES (?, ?, ?, ?)");
                $stmt->execute([$login, $mdp, $mail, $pseudo]);
    
                // Message de succès
                echo "<p><font color='green'>Compte créé avec succès !</p>";
                echo "<a href='../index.php'>Retour à l'accueil</a>";
            }
        }
    }
    require_once('../hautbas/footer.php');
?>
</body>
</html>