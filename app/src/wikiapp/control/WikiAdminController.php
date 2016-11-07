<?php

namespace wikiapp\control;

use wikiapp\control\WikiController as WikiController;
use \wikiapp\utils\Authentification as Authentification;
use \wikiapp\model\Page as Page;
use \wikiapp\view\WikiAdminView as WikiAdminView;

class WikiAdminController {
    private $request=null;

    public function __construct(\wikiapp\utils\HttpRequest $http_req){
        $this->request = $http_req ;
    }



    /*
     * Méthode loginUser
     *
     * Affiche le formulaire d'authentification
     *
     */

    public function loginUser() {
      if(isset($_SESSION['user_login'])){
        $this->perso();
      }
      $wikiAdminView = new WikiAdminView(NULL);
      $wikiAdminView->render('login');

        /*
         * Algorithme :
         *
         *  - Créer une instance de la classe WikiAdminView
         *  - execute la vue qui affiche le formulaire de connexion.
         *
         */

    }

    /*
     * Méthode checkUser
     *
     * Verifie l'identifiant et le mot de passe fournie par l'utilisateur
     *
     */

    public function checkUser(){
      $login = $_POST['login'];
      $pass = $_POST['pass'];

      if(filter_var($login, FILTER_SANITIZE_STRING) && filter_var($pass, FILTER_SANITIZE_STRING)){
        $authentification = new Authentification();
        $authentification = $authentification->login($login, $pass);
        if($authentification){
          $this->userSpace();
        }else{
          $this->loginUser();
          echo "Les login et mot de passe tapés ne correspondent pas.";
        }
      }

        /*
         *  Algorithme :
         *
         * - Récupérer les données du formulaire de connexion
         * - Filtrer les donnée !!!
         * - Créer une instance de la classe Authentification et verifier
         *   l'identifiant et le mots de passe

         *   => (Indication : pour simplifier on peut coder une méthode
         *       User::findByName() qui retourne un objet User pour avoir
         *       les information den BD)

         * - Si les informations sont correctes
         *   - afficher l'espace personel de l'utilisateur
         * - sinon
         *   - afficher le formulaire de connexion.
         *
         */

    }

    /*
     * Méthode logoutUser
     *
     * Réalise la deconnexion d'un utilisateur
     *
     */

    public function logoutUser(){
      $authentification = new Authentification();
      $authentification->logout();
      header('location: ../..');
        /*
         * Algorithme :
         *
         * - Exécute la méthode de decconexion de la classe Authentification
         * - Exécute la fonctionalité par défaut de l'application
         *
         */


     }


    /*
     * userSpace
     *
     * Réalise la fonctionnalité "afficher l'espace de l'utilisateur"
     *
     */

    public function userSpace(){
      $pages = Page::findAll();
      $wikiAdminView = new WikiAdminView($pages);
      $wikiAdminView->render('perso');

        /*
         * Algorithme :
         *
         * - si l'utilisateur est connecté
         *    - récupérer les articles de l'utilisteur
         *    - creer la vue necéssaire et afficher les article
         * - sinon
         *    - afficher le formulaire de connexion.
         */

    }

}
