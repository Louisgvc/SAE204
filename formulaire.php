<?php
//echo 'Info pour debug';
//echo '<pre>';
//echo "Variable Get : "; print_r($_GET);
//echo "Variable POS : "; print_r($_SESSION);
// echo '</pre>';

//recupere les donne du formulaire

$prenom=$_GET["prenom"];
$nom=$_GET["nom"];
$email=$_GET["email"];
$password=$_GET["password"];
echo "<p>" ;
echo "<p>nom : $nom prenom :  $prenom </p>";
echo "<p>mail : $email </p>";
echo "<p>mot de passe : $password</p>";

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
