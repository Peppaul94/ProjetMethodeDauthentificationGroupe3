<?php
use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
?>
<!doctype html>
<html lang="fr">
  <head>
    <style>
      .centrer {
        text-align: center;
      }

        .carousel-inner {
            max-height: 500px; /* Set max height */
        }
        .carousel-item img {
            max-height: 500px;
            width: auto;
            margin: auto;
            object-fit: contain;
        }

        #Apropos {
    display: flex;        /* Enables flexbox */
    align-items: center;  /* Vertically aligns items */
    justify-content: space-between; /* Spreads items evenly */
    padding: 20px;
    max-width: 900px; /* Adjust width as needed */
    margin: auto; /* Centers the div */
    border: 1px solid #ddd; /* Optional border */
    border-radius: 10px; /* Optional rounded corners */
    background-color: #f9f9f9; /* Optional background */
}

#Apropos img {
    width: 200px; /* Adjust as needed */
    height: auto;
    border-radius: 50%; /* Optional rounded corners */
}

.text-container {
    flex-grow: 1; /* Makes text take up available space */
    text-align: center; /* Aligns text to the left */
    padding: 0 20px; /* Adds spacing */
}

.text-container h3 {
    margin-bottom: 10px; /* Adds space between title and text */
}

.button-container {
    display: flex; /* Aligns buttons in a row */
    flex-direction: column;
    gap: 10px; /* Adds space between buttons */
}

.a {
    padding: 10px 15px;
    text-decoration: none;
    background-color: #007bff; /* Blue background */
    color: white;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
}

.a:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

#footer {
  background-color: black;
  text-align: center;
  color: white;
}

    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projet Méthode d'authentification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
  </head>
  <body>
    <div class= "centrer" id="Intro">
        <h1>Projet Méthode d'authentification</h1>
        <h2>Bienvenue sur notre site!</h2>
        <p>Bienvenue! Ce site à pour objectif de vous offrir toutes les informations météos en fonctions de votre lieu de résidence!</p>
        <p>Voici un carousel résumant les informations de diverses villes: </p>
    </div>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
   <!-- !!AJOUTER API ICI!!. Les villes que j'ai choisi pour la page de présentation sont Paris, Berlin et New York mais peuvent être modifiées -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="Paris.jpg" alt="Paris">
    </div>

    <div class="item">
      <img src="Berlin.jpg" alt="Berlin">
    </div>

    <div class="item">
      <img src="NY.jpg" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="centrer" id="Connexion">
  <p>Vous voulez obtenir des informations sur votre ville? Pas de soucis! Il suffit de vous connecter ou de vous créer un compte</p>
  <a class="btn btn-primary" href="/connexionfr" role="button">Connexion</a>
  <a class="btn btn-primary" href="inscription.php" role="button">Inscription</a>
</div>
<p class= "centrer" id="abc">Voici diverses informations à propos des développeurs de ce site</p>
<div class="centrer" id="Apropos">
  <?php
    if ($_GET["name"] == "yelda") {
        echo "
        <img src='Piano.jpg' alt='Yelda'>
        <div class='text-container'>
            <h3 class='textDev'>Développeuse de système de sécurité</h3>
            <p class='textDev'>Yelda a travaillé sur la seconde partie du projet : Implémentation d’un Système d’Authentification Sécurisé. Elle a plus précisément implémenté le système d'authentification 'OAuth2' afin de garantir la sécurité des utilisateurs.</p>
        </div>";
    } elseif ($_GET["name"] == "paul") {
      echo "
        <img src='Piano.jpg' alt='Paul'>
        <div class='text-container'>
            <h3 class='textDev'>Développeur Web  & Manager</h3>
            <p class='textDev'>Paul a eu pour mission de développer les pages web sans les contenus annexes (systèmes multifactoriel et API). De plus, il a organisé le groupe et a distribué les diverses tâches en fonction des points forts et faibles de chacun.</p>
        </div>";
    } elseif ($_GET["name"] == "eliott") {
      echo "
        <img src='Piano.jpg' alt='Eliott'>
        <div class='text-container'>
            <h3 class='textDev'>Développeur Web</h3>
            <p class='textDev'>En cooppération avec Rayan, Eliott  a été chargé d'implémenter toutes les fonctionnalités faisant appel à l'API du site web OpenWeatherMap permettant ainsi à notre site Internet de donner des informations métérologiques.</p>
        </div>";
    } elseif ($_GET["name"] == "karim") {
      echo "
        <img src='Piano.jpg' alt='Karim'>
        <div class='text-container'>
            <h3 class='textDev'>Développeur de systèmes de sécurité</h3>
            <p class='textDev'>Karim a travaillé sur la seconde partie du projet : Implémentation d’un Système d’Authentification Sécurisé. Il a plus précisément implémenté le système d'authentification 'MFA' afin de garantir la sécurité des utilisateurs.</p>
        </div>";
    }  elseif ($_GET["name"] == "rayan") {
      echo "
        <img src='Piano.jpg' alt='Rayan'>
        <div class='text-container'>
            <h3 class='textDev'>Développeur Web</h3>
            <p class='textDev'>En cooppération avec Eliott, Rayan a été chargé d'implémenter toutes les fonctionnalités faisant appel à l'API du site web OpenWeatherMap permettant ainsi à notre site Internet de donner des informations métérologiques.</p>
        </div>";
    } else {
      echo "
      <img src='Piano.jpg' alt='Yelda'>
      <div class='text-container'>
          <h3 class='textDev'>Développeuse de système de sécurité</h3>
          <p class='textDev'>Yelda a travaillé sur la seconde partie du projet : Implémentation d’un Système d’Authentification Sécurisé. Elle a plus précisément implémenté le système d'authentification 'OAuth2' afin de garantir la sécurité des utilisateurs.</p>
      </div>";
    }
  ?>
  <div class="button-container">
    <a class="a" href="index.php?name=yelda">Yelda</a>
    <a class="a" href="index.php?name=paul">Paul</a>
    <a class="a" href="index.php?name=eliott">Eliott</a>
    <a class="a" href="index.php?name=karim">Karim</a>
    <a class="a" href="index.php?name=rayan">Rayan</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<footer id="footer">
  <p>©Projet Méthode d'authentification. Tous droits réservés</p>
  </footer>
</body>
</html>
