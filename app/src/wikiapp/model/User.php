<?php

namespace wikiapp\model;

use wikiapp\utils\ConnectionFactory as ConnectionFactory;

class User extends AbstractModel{

    private $id, $login, $pass, $level;

    function __construct(){
        $this->db = ConnectionFactory::makeConnection();
    }

    public function __get($attr_name){
        if (property_exists( __CLASS__, $attr_name))
            return $this->$attr_name;
        $emess = __CLASS__ . ": unknown member $attr_name (__get)";
        throw new \Exception($emess);
    }

    public function __set($attr_name, $attr_val){
        if (property_exists( __CLASS__, $attr_name))
            $this->$attr_name=$attr_val;
        else{
            $emess = __CLASS__ . ": unknown member $attr_name (__set)";
            throw new \Exception($emess);
        }
    }

    protected function update(){
        $requete =
				"UPDATE user
				SET
					login=".$this->login .",
					pass=".$this->pass .",
					level=".$this->level ."
				WHERE id=".$this->id;

        $prep = $this->db->prepare($requete);
        $ligne = $this->db->exec($prep);

        return $ligne;
    }

    protected function insert(){

        $requete =
				"INSERT INTO user
				VALUES(
					null,
					".$this->login .",
					".$this->pass .",
					".$this->level ."
				)";

        $prep = $this->db->prepare($requete);
        $ligne = $this->db->exec($prep);

        return $ligne;

    }

    public function save(){
        if (is_null($this->id)) {
            return $this->insert();
        }else {
            return $this->update();
        }
    }

    public function delete(){
        if (is_null($this->id)) {
            return 0;
        }else {
            $requete = "DELETE FROM user WHERE id=".$this->id;
            $prep = $this->db->prepare($requete);
            $ligne = $this->db->exec($prep);
            return $ligne;
        }

    }

    static public function findById($id) {
        $db = ConnectionFactory::makeConnection();
        $requete = "SELECT * FROM user WHERE id=".$id;
        $prep = $db->prepare($requete);
        if ($prep->execute()) {
            return $prep->fetchObject(__CLASS__);
        }else {
            echo "Erreur requete";
        }
    }

    static public function findByUser($login) {
        $db = ConnectionFactory::makeConnection();
        $requete = "SELECT * FROM user WHERE login = '".$login ."'";
        $prep = $db->prepare($requete);
        if ($prep->execute()) {
            return $prep->fetchObject(__CLASS__);
        }else {
            echo "Erreur requete";
        }
    }

    static public function findAll() {
        $db = ConnectionFactory::makeConnection();
        $requete = "SELECT * FROM user";
        $resultat = $db->query($requete);
        if($resultat) {
            return $resultat->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
        }else {
            echo "Erreur";
        }
    }

    public function getPages() {
        $requete = "SELECT * FROM page WHERE author=".$this->author;
        $prep = $this->db->prepare($requete);
        if ($prep->execute()){
            return $prep->fetchAll(\PDO::FETCH_CLASS, Page::class);
        }else {
            echo "Erreur requete";
        }
    }
}
