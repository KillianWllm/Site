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
<body>

    <header>
        <img src="./img/V_D_Décor-Logo.png" alt="Logo V&D Décor">
        <nav class="navbar" role="navigation" >
         <ul class="navbar_links">
             <li class="navbar_link first"><a href="index.php">Accueil</a></li>
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
      
      <main>
        <div id="carousel">
            
            <div class="container-cards">
                <div class="cards-real">
                    <div class="card">
                        <img src="./img/services.jpg" alt="Chantier réalisations">
                    </div>

                    <div class="card">
                        <img src="./img/Doissin-1.jpg" alt="Chantier Doissin">
                    </div>

                    <div class="card">
                        <img src="./img/Doissin-2.jpg" alt="Chantier Doissin">
                    </div>

                    <div class="card">
                        <img src="./img/Doissin-3.jpg" alt="Chantier Doissin">
                    </div>

                    <div class="card">
                        <img src="./img/Doissin-4.jpg" alt="Chantier Doissin">
                    </div>
                </div>
                <div class="description">
                    <div class="lieux">
                        <img src="./img/pin2.png" alt="Icon Localisation">
                        <p>Doissin</p>
                    </div>

                    <div class="date">
                        <img src="./img/calendar1.png" alt="Icon Date">
                        <p>Juin 2021</p>
                    </div>

                    <div class="tache">
                        <img src="./img/pinceau.png" alt="Icon Pinceau">
                        <p>Revêtements Murales </p>
                    </div>
                </div>
            </div>

            <div class="container-cards">
                <div class="cards-real">
                    <div class="card">
                        <img src="./img/revet-sol.jpg" alt="Chantier Chambéry">
                    </div>

                    <div class="card">
                        <img src="./img/chambery-1.jpg" alt="Chantier Chambéry">
                    </div>

                    <div class="card">
                        <img src="./img/chambery-2.jpg" alt="Chantier Chambéry">
                    </div>

                    <div class="card">
                        <img src="./img/chambery-3.jpg" alt="Chantier Chambéry">
                    </div>

                    <div class="card">
                        <img src="./img/chambery-4.jpg" alt="Chantier Chambéry">
                    </div>
                </div>
                <div class="description">
                    <div class="lieux">
                        <img src="./img/pin2.png" alt="Icon Localisation">
                        <p>Chambéry</p>
                    </div>

                    <div class="date">
                        <img src="./img/calendar1.png" alt="Icon Date">
                        <p>Novembre 2021</p>
                    </div>

                    <div class="tache">
                        <img src="./img/pinceau.png" alt="Icon Pinceau">
                        <p>Revêtements sols </p>
                    </div>
                </div>
            </div>

            <div class="container-cards">
                <div class="cards-real">
                    <div class="card">
                        <img src="./img/chantier1-2.jpg" alt="Chantier St Didier De La Tour">
                    </div>

                    <div class="card">
                        <img src="./img/st didier de la tour-1.jpg" alt="Chantier St Didier De La Tour">
                    </div>

                    <div class="card">
                        <img src="./img/chantier1-1.jpg" alt="Chantier St Didier De La Tour">
                    </div>

                    <div class="card">
                        <img src="./img/St didier de la tour-3.jpg" alt="Chantier St Didier De La Tour">
                    </div>

                    <div class="card">
                        <img src="./img/St didier de la tour-2.jpg" alt="Chantier St Didier De La Tour">
                    </div>
                </div>
                <div class="description">
                    <div class="lieux">
                        <img src="./img/pin2.png" alt="Icon Localisation">
                        <p>St didier de la tour</p>
                    </div>

                    <div class="date">
                        <img src="./img/calendar1.png" alt="Icon Date">
                        <p>Février 2022</p>
                    </div>

                    <div class="tache">
                        <img src="./img/pinceau.png" alt="Icon Pinceau">
                        <p>Revêtements Murales | sols </p>
                    </div>
                </div>
            </div>

            <div class="container-cards">
                <div class="cards-real">
                    <div class="card">
                        <img src="./img/lyon-1.jpg" alt="Chantier LYON">
                    </div>

                    <div class="card">
                        <img src="./img/lyon-2.jpg" alt="Chantier LYON">
                    </div>

                    <div class="card">
                        <img src="./img/lyon-3.jpg" alt="Chantier LYON">
                    </div>

                    <div class="card">
                        <img src="./img/Lyon-4.jpg" alt="Chantier LYON">
                    </div>
                </div>
                <div class="description">
                    <div class="lieux">
                        <img src="./img/pin2.png" alt="Icon Localisation">
                        <p>lyon</p>
                    </div>

                    <div class="date">
                        <img src="./img/calendar1.png" alt="Icon Date">
                        <p>Janvier 2022</p>
                    </div>

                    <div class="tache">
                        <img src="./img/pinceau.png" alt="Icon Pinceau">
                        <p>Revêtements Murales </p>
                    </div>
                </div>
            </div>

            <div class="container-cards">
                <div class="cards-real">
                    <div class="card">
                        <img src="./img/virieu-1.jpg" alt="Chantier Val de virieu">
                    </div>

                    <div class="card">
                        <img src="./img/virieu-2.jpg" alt="Chantier Val de virieu">
                    </div>

                    <div class="card">
                        <img src="./img/virieu-3.jpg" alt="Chantier Val de virieu">
                    </div>

                    <div class="card">
                        <img src="./img/virieu-4.jpg" alt="Chantier Val de virieu">
                    </div>
                </div>
                <div class="description">
                    <div class="lieux">
                        <img src="./img/pin2.png" alt="Icon Localisation">
                        <p>val de virieu</p>
                    </div>

                    <div class="date">
                        <img src="./img/calendar1.png" alt="Icon Date">
                        <p>Avril 2022</p>
                    </div>

                    <div class="tache">
                        <img src="./img/pinceau.png" alt="Icon Pinceau">
                        <p>Revêtements Murales </p>
                    </div>
                </div>
            </div>

            <div class="container-cards">
              <div class="cards-real">
                  <div class="card">
                      <img src="./img/st-chris-1.jpg" alt="Chantier St Christophe sur guiers">
                  </div>

                  <div class="card">
                      <img src="./img/st-chris-3.jpg" alt="Chantier St Christophe sur guiers">
                  </div>

                  <div class="card">
                      <img src="./img/st-chris-4.jpg" alt="Chantier St Christophe sur guiers">
                  </div>

                  <div class="card">
                      <img src="./img/st-chris-2.jpg" alt="Chantier St Christophe sur guiers">
                  </div>
              </div>
              <div class="description">
                  <div class="lieux">
                      <img src="./img/pin2.png" alt="Icon Localisation">
                      <p>saint-Christophe sur Guiers</p>
                  </div>

                  <div class="date">
                      <img src="./img/calendar1.png" alt="Icon Date">
                      <p>Mai 2021</p>
                  </div>

                  <div class="tache">
                      <img src="./img/pinceau.png" alt="Icon Pinceau">
                      <p>Revêtements Murales </p>
                  </div>
              </div>
          </div>

          <div class="container-cards">
              <div class="cards-real">
                  <div class="card">
                      <img src="./img/persienne-1.jpg" alt="Chantier Chambéry Persiennes">
                  </div>

                  <div class="card">
                      <img src="./img/persienne-2.jpg" alt="Chantier Chambéry Persiennes">
                  </div>

                  <div class="card">
                      <img src="./img/persienne-3.jpg" alt="Chantier Chambéry Persiennes">
                  </div>

              </div>
              <div class="description">
                  <div class="lieux">
                      <img src="./img/pin2.png" alt="Icon Localisation">
                      <p>Chambéry</p>
                  </div>

                  <div class="date">
                      <img src="./img/calendar1.png" alt="Icon Date">
                      <p>Avril 2021</p>
                  </div>

                  <div class="tache">
                      <img src="./img/pinceau.png" alt="Icon Pinceau">
                      <p>Peintures extérieures </p>
                  </div>
              </div>
          </div>
        </div>
      </main>
    
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