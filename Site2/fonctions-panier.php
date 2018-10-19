<?php

/**
 * Verifie si le panier existe, le créé sinon
 * @return booleen
 */
function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['Nompro'] = array();
      $_SESSION['panier']['qtteProd'] = array();
      $_SESSION['panier']['PrixPro'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}


/**
 * Ajoute un article dans le panier
 * @param string $Nompro
 * @param int $qtteProd
 * @param float $PrixPro
 * @return void
 */
function ajouterArticle($Nompro,$qtteProd,$PrixPro){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($Nompro,  $_SESSION['panier']['Nompro']);

      if ($positionProduit !== false)
      {
         $_SESSION['panier']['qtteProd'][$positionProduit] += $qtteProd ;
      }
      else
      {
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['Nompro'],$Nompro);
         array_push( $_SESSION['panier']['qtteProd'],$qtteProd);
         array_push( $_SESSION['panier']['PrixPro'],$PrixPro);
      }
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}



/**
 * Modifie la quantité d'un article
 * @param $Nompro
 * @param $qtteProd
 * @return void
 */
function modifierQTeArticle($Nompro,$qtteProd){
   //Si le panier éxiste
   if (creationPanier() && !isVerrouille())
   {
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($qtteProd > 0)
      {
         //Recharche du produit dans le panier
         $positionProduit = array_search($Nompro,  $_SESSION['panier']['Nompro']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['qtteProd'][$positionProduit] = $qtteProd ;
         }
      }
      else
      supprimerArticle($Nompro);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

/**
 * Supprime un article du panier
 * @param $Nompro
 * @return unknown_type
 */
function supprimerArticle($Nompro){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Nous allons passer par un panier temporaire
      $tmp=array();
      $tmp['Nompro'] = array();
      $tmp['qtteProd'] = array();
      $tmp['PrixPro'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];

      for($i = 0; $i < count($_SESSION['panier']['Nompro']); $i++)
      {
         if ($_SESSION['panier']['Nompro'][$i] !== $Nompro)
         {
            array_push( $tmp['Nompro'],$_SESSION['panier']['Nompro'][$i]);
            array_push( $tmp['qtteProd'],$_SESSION['panier']['qtteProd'][$i]);
            array_push( $tmp['PrixPro'],$_SESSION['panier']['PrixPro'][$i]);
         }

      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}


/**
 * Montant total du panier
 * @return int
 */
function MontantGlobal(){
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['Nompro']); $i++)
   {
      $total += $_SESSION['panier']['qtteProd'][$i] * $_SESSION['panier']['PrixPro'][$i];
   }
   return $total;
}


/**
 * Fonction de suppression du panier
 * @return void
 */
function supprimePanier(){
   unset($_SESSION['panier']);
}

/**
 * Permet de savoir si le panier est verrouillé
 * @return booleen
 */
function isVerrouille(){
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
   return true;
   else
   return false;
}

/**
 * Compte le nombre d'articles différents dans le panier
 * @return int
 */
function compterArticles()
{
   if (isset($_SESSION['panier']))
   return count($_SESSION['panier']['Nompro']);
   else
   return 0;

}

?>