<?php

namespace wikiapp\utils;

use wikiapp\model\User as User;

Class Authentification extends AbstractAuthentification{

	public function __construct(){

		$this->logged_in = true;

	}

	public function login($login, $pass){

		$user = User::findByUser($login);
		if($user->login){
			if(password_verify($pass, $user->pass)){
				$_SESSION['user_login'] = $login;
				$_SESSION['access_level'] = $user->level;
				$this->user_login = $login;
				$this->access_level = $user->level;
				return true;
			}
		}

	}

	public function logout(){

		unset($_SESSION["user_login"]);
		unset($_SESSION["access_level"]);
		unset($this->user_login);
		unset($this->access_level);
		$this->logged_in = false;
		return "Vous avez bien été déconnecté.";

	}

	public function checkAccessRight($requested){

		$access_level = $this->access_level;

		if($access_level >= $requested){
			return true;
		}else{
			return false;
		}

	}

	public function createUser($login, $pass, $level){

    $db = ConnectionFactory::makeConnection();

		$password = password_hash($pass, PASSWORD_DEFAULT);
		add_user($login, $password, $level);
		$requete = "
							INSERT INTO user
							VALUES(
								NULL,
								'".$login ."',
								'".$pass ."',
								'".$level ."'
							)";
		$prep = $db->prepare($requete);
		$res = $db->exec($prep);

		return $login ." a bien été inscrit.";

	}

}
