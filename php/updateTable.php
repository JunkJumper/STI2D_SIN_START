<?php
/**
 *  ----------------------------------------------------------------------------
 * |                             updateTable.php                                |
 * |                    Objectif : paramétrer la base de données                |
 * |                                                                            |
 * | @author     JunkJumper                                                     |
 * | @copyright  2019 - JunkJumper                                              |
 * | @license    https://creativecommons.org/licenses/by/4.0/  License CC BY 4.0|
 * | @since      File available since 10/08/2019                                |
 *  ----------------------------------------------------------------------------
 * 
 * Le but de ce script est tranformer le contenu d'une table SQL du type
 * 
 *  TABLE NAME : infos
 *  ________________________________________________
 *  |id         |nom            |prenom            |
 *  ------------------------------------------------
 *  |1          |Dupont         |Jean              |
 *  ------------------------------------------------
 * en
 * 
 *  TABLE NAME : infos
 *  ________________________________________________
 *  |id         |nom            |prenom            |
 *  ------------------------------------------------
 *  |1          |Martin         |Jean              |
 *  ------------------------------------------------
 */

include "database.php"; //cette instruction est necessaire pour obtenir la configuration que vous avez définie dans le fichier databases.php

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
  // Si il y a une erreur, arret du script.
  die('Erreur : '.$e->getMessage());
}

$sql = "UPDATE infos SET nom = 'Martin' WHERE id = 1";
// Preparation de la requête :
$stmt = $conn->prepare($sql);
	
// execution de la requête :
$stmt->execute();

//puis on reset la variable
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <style>
    table, th, td {
      border: 1px solid black;
      text-align : center;
    }

    th.E {
      padding-right:15px;
      padding-left:15px;
    }

    p#desc {
      color : red;
    }
    </style>
</head>

<?php 
/* IGNORE CE BLOC */
try {
  // Connection MySQL.
      $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  } catch(Exception $e) {
      // Si il y a une erreur, arret du script.
          die('Erreur : '.$e->getMessage());
  } // Récupération du contenu de la table "infos"
  
  $reponse = $bdd->query('SELECT * FROM infos WHERE id=1');
  $donnee = $reponse->fetch();
?>

<body>
    <p id="desc">Voici un appercu de la table infos après modification.</p>
    <table>
      <tr>
        <th class="E">ID</th>
        <th class="E">Nom</th>
        <th class="E">Prénom</th>
      </tr>
      <tr>
        <td><?php echo $donnee['id']; ?></td><!-- Sur ces 3 lignes, on affiche les données contenues dans le tableau "$données" -->
        <td><?php echo $donnee['nom']; ?></td>
        <td><?php echo $donnee['prenom']; ?></td>
      </tr>
    </table>
</body>
</html>

<?php
$reponse -> closeCursor(); // Termine le traitement de la requête
?>
