Bienvenue sur notre application !
=================================

Ce fichier a pour but d'expliquer de manière générale les différentes fonctionnalités de notre site web. Vous y retrouverez notamment :

- Une description de l'application ;
- Une liste des fonctionnalités proposées par notre site web ;
- De quelle manière nous garantissons la sécurité des utilisateurs ;
- L'API utilisée et son utilité.

=================================

Description de l'application

=================================

Notre site Internet indique les informations météorologiques actuelles concernant votre ville de résidence.
Ainsi, plus besoin de réfléchir ! En quelques clics, vous savez précisément la météo et pouvez adapter vos activités en fonction de ces données. Plus besoin de chercher pendant dix minutes la ville qui vous intéresse sur une carte 😉

=================================

Fonctionnalités

=================================

Pour simplifier la vie des utilisateurs, nous utilisons l'API (Application Programming Interface) du site OpenWeatherMap. Grâce à cela, nous pouvons récupérer en temps réel les informations météo de toutes les villes du monde.

La seconde fonctionnalité principale est le système de connexion : une fois connecté, l'utilisateur obtient en temps réel les informations météo de sa ville de résidence.
Dans un souci de sécurité, nous avons ajouté un système de double authentification afin de garantir la confidentialité des utilisateurs.

=================================

Système de double authentification

=================================

Afin de garantir la sécurité des utilisateurs, nous avons utilisé le système de double authentification proposé par Google Authenticator. Ainsi, même si un mot de passe est compromis, un pirate informatique ne pourra pas voler la session d'un utilisateur.
Pour implémenter ce système, nous avons d'abord configuré le système de Google Authenticator dans le fichier "scheb_2fa.yaml". Ensuite, nous avons configuré le système permettant de vérifier que la double authentification est activée pour ce compte. Pour finir, on utilise un contrôleur pour traiter les demandes.

Configuration de Google Authenticator ===>
google:
  enabled: true
  server_name: local.host     
  issuer: Météo Efrei         
  digits: 6                   
  leeway: 0

Contrôleur de la double authentification ===>
public function login(
  #[CurrentUser] ?User $user,
  Request $request,
  AuthenticationUtils $helper
)
if ($user) {
  if (!$user->isGoogleAuthenticatorEnabled()) {
    return $this->redirectToRoute('2fa_setup', ['_locale' => 'fr']);
  }
  ...
}

=================================

Implémentation de l'API

=================================

Les données de l'API sont présentes sur la page d'accueil et sur la page qui suit la connexion réussie d'un utilisateur. Ces deux pages sont "homepage.html.twig" et "index.html.twig". Malheureusement, il est impossible d'utiliser du PHP dans des fichiers .html.twig. C'est pourquoi nous avons utilisé des contrôleurs.
Les contrôleurs concernés sont "HomepageController.php" et "BlogController.php" (celui rangé dans le dossier "Admin"). Ils contrôlent respectivement la page d'accueil et la page qui suit la connexion.

HomepageController.php :

Dans la page de connexion, l'objectif était de faire un Carousel donnant plusieurs informations météo concernant des capitales. Pour ce faire, nous avons utilisé des tableaux et une boucle foreach :

Le tableau contenant les villes ===> $cities = ['Paris', 'Berlin', 'Moscow'];

Le tableau vide dans un premier temps puis rempli par les données retournées par l'API ===> $weatherData = [];

La boucle ===> foreach ($cities as $city)

L'URL de la requête ===> $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

Condition vérifiant que la requête a bien retourné des données ===> 
if ($response !== false) {
  $data = json_decode($response);
  if ($data !== null && isset($data->main)) {
    $weatherData[] = $data;
  }
}

Ainsi, nous récupérons les informations pour Paris, Berlin et Moscou dans la variable "$weatherData"

BlogController.php :

Ici, la difficulté principale était de récupérer la ville de résidence de l'utilisateur. Pour ce faire, nous avons modifié la base de données afin d'enregistrer la ville. Ainsi, il ne restait plus qu'à la récupérer ! Le fonctionnement est ensuite très similaire à celui expliqué pour "HomepageController.php"

Ligne récupérant la ville de l'utilisateur ===> $city = $user->getCity() ?? 'paris';

Requête API ===> $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

Condition pour vérifier que le résultat n'est pas vide ===> 
$weather = null;
try {
  $response = @file_get_contents($url);
  if ($response !== false) {
    $weather = json_decode($response);
  }
} catch (\Exception $e) {
}

Côté HTML :

Une fois les requêtes et données effectuées, il faut les afficher. La manière de faire est identique pour les deux pages.

Par exemple, pour récupérer le nom de la ville ===> <h2>{{ weather.name }} Weather Status</h2>

=================================

Contacts

=================================

Pour nous contacter, voici les emails des développeurs :

paul.havard@efrei.net  
yelda.celayir@efrei.net  
karim.stanislas-constantin@efrei.net  
eliott.teubner@efrei.net  
rayan.bounouri@efrei.net

=================================