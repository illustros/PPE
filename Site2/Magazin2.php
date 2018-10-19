<?php

include_once("fonctions-panier.php");

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['Nompro'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

echo '<?xml version="1.0" encoding="utf-8"?>';?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="Untitled.css" type="text/css"> </head>

<body class="">
  <nav class="navbar navbar-expand-md bg-primary navbar-dark" style="background-size:fit;background-repeat:no-repeat;background-position:left top;">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand border border-primary">Navbar</a>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa d-inline fa-lg fa-bookmark-o"></i> Bookmarks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa d-inline fa-lg fa-envelope-o"></i> Contacts</a>
          </li>
        </ul>
        <a class="btn navbar-btn btn-primary ml-2 text-white">
          <i class="fa d-inline fa-lg fa-user-circle-o"></i> Sign in</a>
        <a class="btn btn-default navbar-btn">Sign in</a>
      </div>
    </div>
  </nav>
  <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">
    <a class="btn btn-default navbar-btn text-white" id="Acceuil" href="Version1.html">Accueil</a>
    <a class="btn btn-default navbar-btn text-white" id="depannage" href="Dépanage.html">Dépannage</a>
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbar2SupportedContent">
        <div class="btn-group d-flex">
          <button class="btn dropdown-toggle btn-outline-primary text-white" data-toggle="dropdown">Eléctricité</button>
          <div class="dropdown-menu">
            <a class="dropdown-item text-primary" href="Eclairage.html">Eclairage</a>
            <a class="dropdown-item text-primary" href="Depannage.html">Dépannage</a>
            <a class="dropdown-item text-primary" href="Miseenconformite.html">Mise en conformité</a>
            <a class="dropdown-item text-primary" href="Industriel.html">Industriel</a>
            <a class="dropdown-item text-primary" href="Domestique.html">Domestique</a>
            <a class="dropdown-item text-primary" href="Magazin.html">Magasin</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Courants faibles</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Informatique.html">Informatique</a>
            <a class="dropdown-item" href="Interphone.html">Interphone</a>
            <a class="dropdown-item" href="Alarmeincendie.html">Alarme Incendie</a>
            <a class="dropdown-item" href="Alarmeintrusion.html">Alarme Intrusion</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Télévision</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Television.html">Télésion</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Plomberie</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Salledebain.html">Salle de bain</a>
            <a class="dropdown-item" href="Cuisine.html">Cuisine</a>
            <a class="dropdown-item" href="Adoucisseur.html">Adoucisseur</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Ventilation</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Simpleflux.html">Simple Flux</a>
            <a class="dropdown-item" href="Doubleflux.html">Double Flux</a>
            <a class="dropdown-item" href="Pultcanadien.html">Pult canadien</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Chauffage</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Principe.html">Principe</a>
            <a class="dropdown-item" href="Chaufelectrique.html">Eléctrique</a>
            <a class="dropdown-item" href="Pompeachaleur.html">Pompe à chaleur</a>
            <a class="dropdown-item" href="Chaudiere.html">Chaudière&nbsp;</a>
            <a class="dropdown-item" href="Solaire.html">Solaire</a>
            <a class="dropdown-item" href="Piscine.html">Piscine</a>
            <a class="dropdown-item" href="Cuveafuel.html">Cuve à fuel&nbsp;</a>
            <a class="dropdown-item" href="Regulation.html">Régulation thermostat</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Climatisation</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Monosplite.html">Monosplite</a>
            <a class="dropdown-item" href="Multisplite.html">Multisplite</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Solaire</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Photovoltaïque.html">Photovoltaïque</a>
            <a class="dropdown-item" href="Thermique.html">Thermique</a>
          </div>
        </div>
      </div>
    </div>
    <a class="btn navbar-btn mx-2 text-white btn-outline-light" href="M_M_B.html">Maison Madriers Bois</a>
    <a class="btn navbar-btn mx-2 text-white btn-outline-light" href="login1.html">Login</a>
  </nav>
  <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">
    <a class="btn btn-default navbar-btn text-white w-25" id="Acceuil" href="Version1.html">Accueil</a>
    <a class="btn btn-default navbar-btn text-white" id="depannage" href="Dépanage.html">Dépannage</a>
    <a class="btn btn-default navbar-btn text-white mx-3 px-3" id="depannage" href="Dépanage.html">Magasin</a>
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbar2SupportedContent">
        <div class="btn-group d-flex">
          <button class="btn dropdown-toggle text-white btn-primary" data-toggle="dropdown">Eléctricité</button>
          <div class="dropdown-menu">
            <a class="dropdown-item text-primary" href="Eclairage.html">Courants Forts</a>
            <a class="dropdown-item text-primary" href="Depannage.html">Courants Faibles</a>
            <a class="dropdown-item text-primary" href="Miseenconformite.html">Télévision</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Maison</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Salledebain.html">Plomberie</a>
            <a class="dropdown-item" href="Cuisine.html">Ventillation</a>
            <a class="dropdown-item" href="Adoucisseur.html">Chaufage</a>
            <a class="dropdown-item" href="Adoucisseur.html">Climatisation</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Energie</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Monosplite.html">Solaire</a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-outline-primary dropdown-toggle text-white" data-toggle="dropdown">Construction</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Photovoltaïque.html">Maison Madriers Bois</a>
          </div>
        </div>
      </div>
    </div>
    <a class="btn navbar-btn text-white btn-outline-light mx-2 w-25" href="login1.html">Login</a>
  </nav>




  <div class="py-5 bg-secondary">
    <div class="container">
      <div class="row bg-secondary">
        <div class="col-md-12 bg-secondary"></div>
      </div>
      <div class="row">
        <div class="col-md-12"></div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 bg-secondary">
          <form method="post" action="Magazin.php">
            <div class="container">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group w-75">
                    <label>Nom du produit</label>
                    <input type="text" class="form-control" name="NomPro"> </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group w-100">
                        <label>Prix minimum</label>
                        <input type="number" class="form-control w-100" name="prixmin" placeholder="0"> </div>
                    </div>
                    <div class="col-md-6 w-100">
                      <div class="form-group w-100">
                        <label>Prix maximum</label>
                        <input type="number" class="form-control w-100" name="prixmax" placeholder="10000"> </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group w-75">
                    <lavel>Type de produit recherché</lavel>
                    <select class="form-control w-100" name="NumTypePro">
                        <option value="0" selected>Tout</option>
                      <optgroup label="Electricité">
                        <option value="1">Lumière</option>
                        <option value="2">Alarme</option>
                        <option value="3">Interphone</option>
                        <option value="4">Cablage</option>
                      </optgroup>
                      <optgroup label="Climatisation">
                        <option value=""></option>
                        <option value=""></option>
                      </optgroup>
                      <optgroup label="Plomberie">
                        <option value=""></option>
                        <option value=""></option>
                      </optgroup>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <p class="lead"> </p>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary" id="chercher">Chercher</button><br><br>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>




















    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            


          <table>
            <tbody>
              <tr>
                <th class="w-25 px-4" id="imageproduit">Image Produit</th>
                <th id="nomproduit" class="px-5 w-25">Nom Produit</th>
                <th id="prixproduit" class="px-5">Prix Produit</th>
                <th id="Commentaire" class="px-5">Commentaire</th>
              </tr>
 <?php
   

    try
        {

        $bdd = new PDO('mysql:host=localhost;dbname=BDD', 'root', '');
        // connection a la base de donnees via Mysql

        }
     catch (Exception $e)
     // on capture l'erreur (l'exception)
         {

                 die('Erreur :' .$e->getMessage()); // en cas d'erreur, on affiche un message avec arret de l'execution de la page 
               } 



if(empty($_POST['prixmin']))
{
  $a=0;
}
else
{
  $a=$_POST['prixmin'];
}

if(empty($_POST['prixmax']))
{
  $b=100000;
}
else
{
  $b=$_POST['prixmax'];
}

if(empty($_POST['NumTypePro']) || is_null($_POST['NumTypePro']))
{
  $c='%';
}
else
{
  $c=$_POST['NumTypePro'];
}

if(empty($_POST['NomPro']))
{
  $d='%';
}
else
{
  $d='%'.$_POST['NomPro'].'%';
}

$reponse = $bdd->query("SELECT * FROM produit WHERE PrixPro between '$a' and '$b' and NumTypePro like '$c' and NomPro like '$d' ; ")or die(print_r($bdd->errorInfo()));
            while($enreg=$reponse->fetch()) { ?>
             
          
              
              <tr>
                <td>
                  <img src=Image/<?php echo $enreg['NumProduit']?>.jpg  style="width: 75%;"> </td>
                <td class="px-5">
                  
                  <p class="lead"><?php echo $enreg['NomPro']?> </p>
                </td>
                <td class="px-5">
                  
                  <h1 class=""><?php echo $enreg['PrixPro']; ?></h1>
                </td>
                <td class="px-5">
                  
                  <p class=""><?php echo $enreg['ComPro']; ?></p>
                </td>
                <td style="width: 30%;">
                  <div class="ajt">
                    <a style="color: white;" href="panier.php?action=ajout&amp;l=<?php echo $enreg['NomPro']; ?>&amp;q=1&amp;p=<?php echo $enreg['PrixPro']; ?>">Ajouter au panier</a>
                  </div>
                </td>
              </tr>
          <?php } ?>
            </tbody>
          </table>

          <a href="Affichpanier.php" class="ajt">&nbsp &nbsp Panier &nbsp &nbsp</a>








































          </div>
        </div>
      </div>
    </div>
    <div class="py-5 bg-primary">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <img class="img-fluid d-block" src="image/crbst_pg_202013.png"> </div>
          <div class="col-md-3">
            <img class="img-fluid d-block" src="image/crbst_logo-Qualibois-2015-RGE.jpg"> </div>
          <div class="col-md-3">
            <img class="img-fluid d-block" src="image/crbst_logo_pmg_2013.jpg"> </div>
          <div class="col-md-3">
            <a class="btn btn-primary" href="Contact.html">Nous Contacter&nbsp;
              <br> </a>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 10px;right:10px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:180px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo&nbsp;&nbsp;
      <img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16">
    </pingendo>
  </div>
  
</body>

</html>