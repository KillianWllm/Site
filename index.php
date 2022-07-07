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
             <li class="navbar_link first">
              <a href="index.php">Accueil</a>
              <ul class="sub-menu">
                <li class="first-li">
                    <a href="#service">Nos Services</a>
                </li>
                <li>
                    <a href="#presentation">Qui sommes-nous ?</a>
                </li>
                <li>
                  <a href="#partenaire">Nos Partenaires</a>
              </li>
              <li>
                  <a href="#avis">Ils nous ont fait confiance</a>
              </li>
              <li>
                <a href="#atout">Nos Atouts</a>
            </li>
            </ul>
            </li>
             <li class="navbar_link second"><a href="realisation.php">Réalisations</a></li>
             <li class="navbar_link second"><a href="nuancier.php">Nuancier</a></li>
             <button class="navbar_link btn-1 modal-trigger">Demandez un devis</button>
       </ul>
         <button class="burger">
             <span class="bar"></span>
         </button>
         </nav>
      </header>

      <section class="background">
        <div class="container">
            <h1>V&D Décor<br>Peinture revêtements<strong>.</strong></h1>
            <p>V&D vous propose leurs savoir-faire dans le <br> domaine des revêtements des murs et sols</p>
            <button class="btn-2 modal-trigger">Demandez un devis</button>
        </div>
        <div id="form" class="modal-container">
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
                 <input class="btn-form" type="submit" value="envoyer">
               </form>
            </div>
         </div>
      </section>

      <main id="service" class="service">
        <h2>Nos Services</h2>
        <div class="cards">
          <div class="card">
            <div class="img-container">
              <img src="./img/service1-1.jpg" alt="Exemple de Peinture Murales">
            </div>
            <h3>Murs & Plafonds</h3>
            <p>Le revêtement mural est la raison d’être de notre entreprise il protège vos murs et cloisons tout en étant décoratif. Il existe une multitude de revêtements pour les murs, encore faut-il choisir celui qui convient à votre projet, à vos goûts et à votre budget.</p>
            <a href="realisation.php">Réalisations</a>
          </div>

          <div class="card">
            <div class="img-container">
              <img src="./img/card-2.jpg" alt="Exemple de Peinture Sols">
            </div>
            <h3>Sols & Parquets</h3>
            <p>Un revêtement de sol est un matériau de construction, naturel ou manufacturé, qui couvre le sol. Comme tout autre revêtement, il sert de protection ou de décoration mais il est spécifiquement adapté pour résister aux passages des personnes.</p>
            <a href="realisation.php">Réalisations</a>
          </div>

          <div class="card">
            <div class="img-container">
              <img src="./img/services-3.jpg" alt="Exemple de Peinture Extérieur">
            </div>
            <h3>Extérieurs</h3>
            <p>La peinture extérieure possède des caractéristiques spécifiques pour résister aux contraintes climatiques. Vous avez le choix entre plusieurs types de peintures extérieures, en phase aqueuse comme en phase solvant. Ainsi que la peinture minérale <br> à la chaux.</p>
            <a href="realisation.php">Réalisations</a>
          </div>
        </div>
      </main>

   <article id="presentation" class="why-buy">
      <img src="./img/qui-sommes-nous.jpg" alt="Santorini">
     <div class="container">
      <h2>Qui sommes-nous ?</h2>
      <div class="container-paragraphe">
            <p>Créée en 2019 par deux jeunes isérois passionnés par la peinture en bâtiment et soucieux de proposer des travaux de qualité à ses clients, V&D Décor est une entreprise rigoureuse et responsable située à La Tour Du Pin.</p>

            <p>Fort de notre équipe de peintres expérimentés et dynamiques, V&D Décor vous accompagne dans tous vos projets de peinture générale : construction neuve, rénovation, extension. Notre savoir-faire et nos nombreuses années d’expériences nous permettent de mettre à votre disposition nos qualifications, et de vous garantir des travaux de qualité respectant les normes, afin de satisfaire tout autant les besoins des clients professionnels et particuliers.</p>
  
            <p>Notre priorité est votre satisfaction et votre confiance, c’est pourquoi nous travaillons en étroite collaboration avec des entreprises locales qui connaissent parfaitement les besoins et impératifs locaux.</p>
          </div>
    </div>
   </article>

   <section id="partenaire" class="partenaire">
        <h2>Nos Partenaires</h2>
        <div class="marques">
          <img src="./img/logo-seigneurie.jpg" alt="Logo Seigneurie">
          <img src="./img/Sikkens-Logo.jpg" alt="Logo Sikkens">
          <img src="./img/zolpan-logo.png" alt="Logo Zolpan">
          <img src="./img/autocollants-makita-logo.jpg" alt="Logo Makita">
        </div>
      </section>

      <section id="avis" class="avis">
        <h2>Ils nous ont fait confiance</h2>
        <div id="carousel">
          <div class="container-avis">
            <div class="column">
              <div class="top">
                <img src="./img/guillemet.png" alt="guillemet">
                <h3>Camille D,</h3>
                <div class="rating">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/stars-2.png" alt="Etoile avis">
                </div>
              </div>
              <p>"Je vous remercie de votre professionnalisme, de votre rapidité et de votre bienveillance!
                  La peinture a été faite très vite et on voit que vous faites attention à tous les détails !
                  Je vous recommande à 100 % et je communiquerai avec vous au besoin!
                  À bientôt et merci encore !!"</p>
              <a href="realisation.php">Réalisations</a>
            </div>
          </div>

          <div class="container-avis">
            <div class="column">
              <div class="top">
                <img src="./img/guillemet.png" alt="guillemet">
                <h3>Michel D,</h3>
                      <div class="rating">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                </div>
              </div>
              <p>"Entreprise sérieuse, réactive, ponctuelle, très bon travail réalisé.
                  rapport qualité prix raisonnable. 
                  Qualité du travail : très bon dans le souci du détail , très minutieux. 
                  Entreprise à recommander vivement."</p>
              <a href="realisation.php">Réalisations</a>
            </div>
          </div>

          <div class="container-avis">
            <div class="column">
              <div class="top">
                <img src="./img/guillemet.png" alt="guillemet">
                <h3>Julien Lb,</h3>
                      <div class="rating">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                </div>
              </div>
              <p>"Personnel très professionnel avec un travail de qualité réalisé.
                  Je conseille leurs prestations !"</p>
              <a href="realisation.php">Réalisations</a>
            </div>
          </div>

          <div class="container-avis">
            <div class="column">
              <div class="top">
                <img src="./img/guillemet.png" alt="guillemet">
                <h3>Magali C,</h3>
                          <div class="rating">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/stars-2.png" alt="Etoile avis">
                </div>
              </div>
              <p>"Un super patron et très bonne équipe...très pro très bonne qualité de travail"</p>
              <a href="realisation.php">Réalisations</a>
            </div>
          </div>

          <div class="container-avis">
            <div class="column">
              <div class="top">
                <img src="./img/guillemet.png" alt="guillemet">
                <h3>Marine Klemmer,</h3>
                        <div class="rating">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                </div>
              </div>
              <p>"Nous sommes très satisfaits du travail de M. Williame. Nous avons désormais une très belle salle de bain toute neuve. Je vous le recommande à 100%"</p>
              <a href="realisation.php">Réalisations</a>
            </div>
          </div>

          <div class="container-avis">
            <div class="column">
              <div class="top">
                <img src="./img/guillemet.png" alt="guillemet">
                <h3>Hamza Bnb,,</h3>
                <div class="rating">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/star.png" alt="Etoile avis">
                  <img src="./img/stars-2.png" alt="Etoile avis">
                </div>
              </div>
              <p>"Très satisfait de l'entreprise V&D Décor, équipe professionnelle, ponctuelle et minutieuse du travail effectué. Je recommande vivement."</p>
              <a href="realisation.php">Réalisations</a>
            </div>
          </div>
        </div>
      </section>

      <section id="atout" class="atout">
        <h2>Nos Atouts</h2>
        <div class="cards">
          <div class="card-atout">
            <img src="./img/questionnaire.png" alt="Icon Devis">
            <h4>Devis gratuit et détaillé</h4>
            <p>Nous réalisons des devis sur-mesure, personnalisés et gratuits.</p>
          </div>

          <div class="card-atout">
            <img src="./img/reponses.png" alt="Icon Reponses">
            <h4>Réponse rapide à toutes vos questions</h4>
            <p>Notre équipe est à votre entière disposition pour répondre à vos interrogations de manière claire et concise.</p>
          </div>

          <div class="card-atout">
            <img src="./img/poignee-de-main.png" alt="Icon Poignée de main">
            <h4>Accompagnement et suivi de chantier</h4>
            <p>Faire appel à V&D Décor, c'est bénéficier d'un interlocuteur unique et sérieux pendant toute la durée du projet.</p>
          </div>
        </div>
      </section>

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
                <a class="footer-menu-name" href="#presentation"> Qui sommes-nous</a>
                <a class="footer-menu-name" href="realisation.php"> Réalisations</a>
                <a class="footer-menu-name" href="nuancier.php"> Nuancier</a>
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