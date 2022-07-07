<?php

try{
  $bdd = new PDO('mysql:host=localhost;dbname=vd_admin;', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "La connexion a bien été etablie";
}
catch(PDOException $e){
  echo "La connexion a echoué:" . $e->getMessage();
}
if(!empty($_POST)){
  if(
    isset($_POST["tel"], $_POST['nom'], $_POST['prenom'], $_POST['ville'], $_POST['demande'])
    && !empty($_POST['tel']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['ville']) && !empty($_POST['demande'])
  ){
    $tel = strip_tags($_POST['tel']);
    $nom = strip_tags($_POST['nom']);
    $prenom = strip_tags($_POST['prenom']);
    $ville = strip_tags($_POST['ville']);
    $demande = nl2br(htmlspecialchars($_POST['demande']));

    $sql = "INSERT INTO `devis`(`tel`, `nom`, `prenom`, `ville`, `demande`) VALUES (:tel, :nom, :prenom, :ville, :demande)";

    $query = $bdd->prepare($sql);

    $query->bindValue(":tel", $tel);
    $query->bindValue(":nom", $nom);
    $query->bindValue(":prenom", $prenom);
    $query->bindValue(":ville", $ville);
    $query->bindValue(":demande", $demande);

    if(!$query->execute()){
      die("Une erreur est survenue");
    }

    $id = $bdd->lastInsertId();

    echo "<script>alert(\"Votre devis a bien été transmis sous le numéro $id\")</script>";
  }else{
    echo "<script>alert(\"Formulaire incomplet\")</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>V&D Décor | Peinture en Bâtiment</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="nuancier-body">
    
    <header>
        <img src="./img/V_D_Décor-Logo.png" alt="Logo V&D Décor">
        <nav class="navbar" role="navigation" >
         <ul class="navbar_links">
             <li class="navbar_link first">
              <a href="index.php">Accueil</a>
            </li>
             <li class="navbar_link second"><a href="realisation.php">Réalisations</a></li>
             <li class="navbar_link second"><a href="nuancier.php">Nuancier</a></li>
             <button class="navbar_link btn-1 modal-trigger">Demandez un devis</button>
       </ul>
         <button class="burger">
             <span class="bar"></span>
         </button>
         </nav>
         <div class="modal-container">
          <div class="overlay modal-trigger"></div>
          <div class="modal">
            <button class="close-modal modal-trigger">X</button>
            <h3>Demandez un devis</h3>
            <p>Soyez recontacté !</p>
            <form method="post">
              <div>
               <label>Téléphone <span>*</span></label>
               <input type="tel" name="tel" placeholder="+336564582" required>
              </div>
              <div>
               <label>Nom <span>*</span></label>
               <input type="text" name="nom" placeholder="Nom" required>
              </div>
              <div>
                <label>Prénom <span>*</span></label>
                <input type="text" name="prenom" placeholder="Prénom" required>
               </div>
              <div>
               <label>Ville <span>*</span></label>
               <input type="text" name="ville" required>
              </div>
              <div>
               <label>Message <span>*</span></label>
               <textarea name="demande" required placeholder="Envoyer nous votre demande"></textarea>
              </div>
               <input class="btn-form" type="submit">
             </form>
          </div>
       </div>
      </header>

    <div class="container-nuancier">
        <h2>Choisissez vos couleurs</h2>
        <div id="flatuarlina">
          <ul class="flatui">
            <li style="background: #5C97BF;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #5C97BF</span>
            </li>
            <li style="background: #4B77BE;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #4B77BE</span>
            </li>
            <li style="background: #1F3A93;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #1F3A93</span>
            </li>
            <li style="background: #2574A9;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #2574A9</span>
            </li>
            <li style="background: #67809F;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #67809F</span>
            </li>
            <li style="background: #34495E;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #34495E</span>
            </li>
            <li style="background: #3A539B;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #3A539B</span>
            </li>
            <li style="background: #1E8BC3;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #1E8BC3</span>
            </li>
            <li style="background: #6BB9F0;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #6BB9F0</span>
            </li>
            <li style="background: #22313F;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #22313F</span>
            </li>
            <li style="background: #336E7B;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #336E7B</span>
            </li>
            <li style="background: #19B5FE;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #19B5FE</span>
            </li>
            <li style="background: #89C4F4;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #89C4F4</span>
            </li>
            <li style="background: #2C3E50;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #2C3E50</span>
            </li>
            <li style="background: #3498DB;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #3498DB</span>
            </li>
            <li style="background: #22A7F0;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #22A7F0</span>
            </li>
            <li style="background: #94E0EE;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #94E0EE</span>
            </li>
            <li style="background: #52B3D9;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #52B3D9</span>
            </li>
            <li style="background: #59ABE3;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #59ABE3</span>
            </li>
            <li style="background: #26A65B;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #26A65B</span>
            </li>
            <li style="background: #1E824C;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #1E824C</span>
            </li>
            <li style="background: #00B16A;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #00B16A</span>
            </li>
            <li style="background: #2ABB9B;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #2ABB9B</span>
            </li>
            <li style="background: #4DAF7C;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #4DAF7C</span>
            </li>
            <li style="background: #03A678;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #03A678</span>
            </li>
            <li style="background: #26C281;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #26C281</span>
            </li>
            <li style="background: #019875;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #019875</span>
            </li>
            <li style="background: #3FC380;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #3FC380</span>
            </li>
            <li style="background: #16A085;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #16A085</span>
            </li>
            <li style="background: #2ECC71;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #2ECC71</span>
            </li>
            <li style="background: #C5EFF7;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #C5EFF7</span>
            </li>
            <li style="background: #C8F7C5;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #C8F7C5</span>
            </li>
            <li style="background: #049372;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #049372</span>
            </li>
            <li style="background: #36D7B7;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #36D7B7</span>
            </li>
            <li style="background: #66CC99;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #66CC99</span>
            </li>
            <li style="background: #1BA39C;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #1BA39C</span>
            </li>
            <li style="background: #1BBC9B;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #1BBC9B</span>
            </li>
            <li style="background: #65C6BB;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #65C6BB</span>
            </li>
            <li style="background: #BFBFBF;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #BFBFBF</span>
            </li>
            <li style="background: #ABB7B7;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #ABB7B7</span>
            </li>
            <li style="background: #DADFE1;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #DADFE1</span>
            </li>
            <li style="background: #95A5A6;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #95A5A6</span>
            </li>
            <li style="background: #C5DCE2;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #C5DCE2</span>
            </li>
            <li style="background: #BDC3C7;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #BDC3C7</span>
            </li>
            <li style="background: #EEEEEE;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #EEEEEE</span>
            </li>
            <li style="background: #D2D7D3;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #D2D7D3</span>
            </li>
            <li style="background: #F0E2C5;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F0E2C5</span>
            </li>
            <li style="background: #EB9532;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #EB9532</span>
            </li>
            <li style="background: #E67E22;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #E67E22</span>
            </li>
            <li style="background: #F27935;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F27935</span>
            </li>
            <li style="background: #F9BF3B;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F9BF3B</span>
            </li>
            <li style="background: #F7CA18;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F7CA18</span>
            </li>
            <li style="background: #F9690E;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F9690E</span>
            </li>
            <li style="background: #F39C12;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F39C12</span>
            </li>
            <li style="background: #D35400;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #D35400</span>
            </li>
            <li style="background: #F4D03F;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F4D03F</span>
            </li>
            <li style="background: #F5AB35;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F5AB35</span>
            </li>
            <li style="background: #EB974E;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #EB974E</span>
            </li>
            <li style="background: #F2784B;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F2784B</span>
            </li>
            <li style="background: #F4B350;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F4B350</span>
            </li>
            <li style="background: #E87E04;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #E87E04</span>
            </li>
            <li style="background: #E74C3C;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #E74C3C</span>
            </li>
            <li style="background: #CF000F;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #CF000F</span>
            </li>
            <li style="background: #C0392B;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #C0392B</span>
            </li>
            <li style="background: #D64541;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #D64541</span>
            </li>
            <li style="background: #EF4836;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #EF4836</span>
            </li>
            <li style="background: #96281B;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #96281B</span>
            </li>
            <li style="background: #D91E18;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #D91E18</span>
            </li>
            <li style="background: #E26A6A;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #E26A6A</span>
            </li>
            <li style="background: #FF0000;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #FF0000</span>
            </li>
            <li style="background: #F22613;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #F22613</span>
            </li>
            <li style="background: #E08283;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #E08283</span>
            </li>
            <li style="background: #9B59B6;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #9B59B6</span>
            </li>
            <li style="background: #8E44AD;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #8E44AD</span>
            </li>
            <li style="background: #BE90D4;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #BE90D4</span>
            </li>
            <li style="background: #BF55EC;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #BF55EC</span>
            </li>
            <li style="background: #9A12B3;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #9A12B3</span>
            </li>
            <li style="background: #913D88;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #913D88</span>
            </li>
            <li style="background: #722D6A;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #722D6A</span>
            </li>
            <li style="background: #740A4E;"><span class="kodebesar"><span class="kodekecil">V&D Décor</span> #740A4E</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="pg-footer">
        <footer class="footer">
          <svg class="footer-wave-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 100" preserveAspectRatio="none">
            <path class="footer-wave-path" d="M851.8,100c125,0,288.3-45,348.2-64V0H0v44c3.7-1,7.3-1.9,11-2.9C80.7,22,151.7,10.8,223.5,6.3C276.7,2.9,330,4,383,9.8 c52.2,5.7,103.3,16.2,153.4,32.8C623.9,71.3,726.8,100,851.8,100z"></path>
          </svg>
          <div class="footer-content">
            <div class="footer-content-column">
              <div class="footer-logo">
                <a class="footer-logo-link" href="index.html">
                  <img src="./img/logo-footer.png" alt="Logo Du Footer">
                </a>
              </div>
              <div class="footer-menu">
                <h2 class="footer-menu-name"> Contact</h2>
                <ul id="menu-get-started" class="footer-menu-list">
                  <li>
                    <img src="./img/telephone.png" alt="">
                    <p>06 14 14 77 89</p>
                  </li>
                  <li>
                    <img src="./img/enveloppe-de-courrier-electronique.png" alt="">
                    <p>willspeinture@gmail.com</p>
                  </li>
                  <li>
                    <img src="./img/pin.png" alt="">
                    <p>38110 La Tour Du Pin</p>
                  </li>
                </ul>
              </div>
            </div>
            <div class="footer-content-column">
              <div class="footer-menu">
                <a class="footer-menu-name" href="index.php#presentation"> Qui sommes-nous</a>
                <a class="footer-menu-name" href="realisation.php"> Réalisations</a>
                <a class="footer-menu-name" href="realisation.php"> Nuancier</a>
              </div>
            </div>
            <div class="footer-content-column">
              <div class="footer-call-to-action">
                <h2 class="footer-call-to-action-title"> une demande ?</h2>
                <p class="footer-call-to-action-description"> Envoyez-nous votre projet</p>
                <a class="footer-call-to-action-button button modal-trigger" href="#" target="_self"> Demandez un devis </a>
              </div>
            </div>
            <div class="footer-content-column">
            <div class="footer-menu">
              <h2 class="footer-menu-name"> Social</h2>
              <ul class="social">
                <a href="">
                  <img src="./img/facebook.png" alt="Icon Facebook">
                </a>
                <a href="">
                  <img src="./img/instagram.png" alt="Icon Instagram">
                </a>
              </ul>
            </div>
          </div>
          </div>
          <div class="footer-copyright">
            <div class="footer-copyright-wrapper">
              <p class="footer-copyright-text">
                <a class="footer-copyright-link" href="#" target="_self"> ©2022. | V&D Décor | Tous droits réservés | Mentions Légales </a>
              </p>
            </div>
          </div>
        </footer>
      </div>
    <script src="script.js"></script>
</body>
</html>