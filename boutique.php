<?php
require_once("inc/init.inc.php");
$TITRE = 'Boutique';

$categorie_des_produits = executeRequete("SELECT DISTINCT categorie FROM produit");
$contenu .= '<div class="boutique-categories">';
$contenu .= "<ul>";
while ($cat = $categorie_des_produits->fetch_assoc()) {
    $contenu .= "<li><a href='?categorie=" . $cat['categorie'].
    "'>" . $cat['categorie'] . "</a></li>";
}
$contenu .= "</ul>";
$contenu .= "</div>";
$contenu .= '<div class="boutique-produits">';
if (isset($_GET['categorie'])) {
    $donnees = executeRequete("select id_produit, reference, titre, photo, prix from produit where categorie='$_GET[categorie]'");
    while ($produit = $donnees ->fetch_assoc()) {
        $contenu .='<div class="boutique-produit">';
        $contenu .="<h2>$produit[titre]</h2>";
        $contenu .="<a href=\"fiche_produit.php? id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\"></a>";
        $contenu .="<p>$produit[prix] €</p>";
        $contenu .='<a href="fiche_produit.php?id_produit=' .
        $produit['id_produit'] . '">Voir la fiche</a>';
        $contenu .='</div>';
    }
}
$contenu .= '</div>';

require_once("inc/haut.inc.php");
echo $contenu;
require_once("inc/bas.inc.php");