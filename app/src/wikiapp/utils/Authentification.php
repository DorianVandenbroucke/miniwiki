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
				$_SESSION['user_id'] = $user->id;
				$this->user_login = $login;
				$this->access_level = $user->level;
				return true;
			}
		}

	}

	public function logout(){

		unset($_SESSION["user_login"]);
		unset($_SESSION["user_id"]);
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

		$pass = password_hash($pass, PASSWORD_DEFAULT);

		$user = new User();
		$user->login = $login;
		$user->pass = $pass;
		$user->level = $level;

		$user->save();
		return true;

	}

}
