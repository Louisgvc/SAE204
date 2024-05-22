<!DOCTYPE html>
<html lang="fr">

  <head>
    <title>Accueil</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="BaseBootstrap/css/style.css">
	
  </head>

  <body>

    <h1>Bienvenue</h1>

    <form action="accueil.php" method="get">
      <fieldset>
        <legend>Connexion</legend>
        <label for="login">Identifiant : </label>
        <input type="text" name="login">
        <label for="mdp">Mot de passe : </label>
        <input type="text" name="mdp">
      </fieldset>
      <input type="submit" value="Se connecter">
    </form>

<?php

try {
    $servername = "127.0.0.1";
    $dbname = "BUTRT1_lg409538";
    $username = "lg409538";
    $userpassword = "MDP_lg409538";
    $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$userpassword");
    $lienBDD->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Acces BDD réaliser";

    //prepare la requete d'insertion
    $requeteSQL = $lienBDD->prepare("
                            SELECT id_admis AS id, nom FROM Admis 
                            UNION
                            SELECT id_etud AS id, nom FROM Etudiants
                            UNION
                            SELECT id_profs AS id, nom FROM Profs");

    //Lire les valeurs des parametres des la requete avec les variables__

    $requeteSQL->bindParam(":identifiant", $id);
    $requeteSQL->bindParam(":password", $password);

    //Execute la reqque de l'insertion
    $requeteSQL->execute();

}
catch (PDOException $e)
{
    die("Erreur : ").$e-> getMessage();
}
//connexion a la BDD
?>

</body>
</html>

