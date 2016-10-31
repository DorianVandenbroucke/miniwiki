<?php

namespace wikiapp\utils;

class ConnectionFactory{

    static private  $config, $db;

    public static function setConfig($nom_fichier){
        self::$config = parse_ini_file($nom_fichier);
    }

    public static function makeConnection(){
        if(is_null(self::$db)){
            //Lien fichier ini
            self::setConfig('conf/config.ini');
            $dsn = "mysql:host=".self::$config['host'].";dbname=".self::$config['dbname'].";charset=".self::$config['charset'];
            try {
                self::$db = new \PDO($dsn, self::$config['user'], self::$config['pass']);
            }catch(PDOException $e){
                /* Erreur de connexion */
                echo "Connection error: $dsn" . $e->getMessage();
                exit;
            }
        }
        return self::$db;
    }
}
