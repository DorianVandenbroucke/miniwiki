<?php

namespace wikiapp\utils;

class Router extends AbstractRouter{

    /*
    * Méthode addRoute : ajoute une route a la liste des route
    *
    * Paramètres :
    *
    * - $url (String)  : l'url de la route
    * - $ctrl (String) : le nom de la classe du Contrôleur
    * - $mth (String)  : le nom de la méthode qui réalise la fonctionalité
    *                     de la route
    * - $level (Integer) : le niveau d'accès nécessaire pour la fonctionnalité
    *
    * Algorithme :
    *
    * - Ajouter le tablau [ $ctrl, $mth, $level ] au tableau $this->route
    *   sous la clé $url
    *
    */

    public function addRoute($url, $ctrl, $mth, $level){
        self::$routes[$url] = [$ctrl, $mth, $level];
    }

    /*
    * Méthode dispatch : execute une route en fonction de la requête
    *
    * Paramètre :
    *
    * - $http_request (HttpRequest) : Une instance de la classe HttpRequest
    *
    * Algorithme :
    *
    * - Si l'attribut $path_info existe dans $http_request
    *   ET si une route existe dans le tableau $route sous le nom $path_info
    *     - créer une instance du controleur de la route
    *     - exécuter la méthode de la route
    * - sinon
    *    - exécuter la route par défaut :
    *        - créer une instance du controleur de la route par défault
    *        - exécuter la méthode de la route par défault
    *
    */

    public function dispatch(HttpRequest $http_request){
        if (!is_null($http_request->path_info) && isset(self::$routes[$http_request->path_info][0])){
            $controller = self::$routes[$http_request->path_info][0];
            $action = self::$routes[$http_request->path_info][1];
            $ctrl = new $controller($http_request);
            $ctrl->$action();

        }else {
            $controller = self::$routes["default"][0];
            $action = self::$routes["default"][1];
            $ctrl = new $controller($http_request);
            $ctrl->$action();

        }
    }

}
