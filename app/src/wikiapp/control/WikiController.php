<?php

namespace wikiapp\control;

use \wikiapp\model\Page as Page;
use \wikiapp\model\User as User;
use \wikiapp\view\WikiView as WikiView;

class WikiController {

    private $request=null;

    public function __construct(\wikiapp\utils\HttpRequest $http_req){
        $this->request = $http_req;
    }

    public function listAll(){
        $pages = Page::findAll();
        $wikiView = new WikiView($pages);
        $wikiView->render('all');
    }

    public function viewPage(){
        $page = Page::findByTitle($_GET['title']);
		$author = User::findById($page->author);
		$page->author = $author->login;
        $wikiView = new WikiView($page);
        $wikiView->render('view');
    }
	
	public function addPage(){
		$form = "
				<form action='#' method='POST'>
					<input type='text' placeholder='Titre' name='title' />
					<br />
					<textarea name='text'>Contenu</textarea>
					<br />
					<input type='submit' value='Ajouter' name='add' />
				</form>
				";
		if(isset($_POST['add'])){
			if(!empty($_POST['title']) && !empty($_POST['text'])){
				$page = new Page();
				$page->title = $_POST['title'];
				$page->text = $_POST['text'];
				$page->date = date('Y-m-d');
				$page->author = 1;
				
				$page->save();
			}
		}
		$wikiView = new WikiView($form);
		$wikiView->render('add');
	}
	
	public function updatePage(){
		
		$p = Page::findByTitle($_GET['title']);
		
		$form = "
				<h1>".$_GET['title'] ."</h1>
				<form action='#' method='POST'>
					<input type='text' placeholder='Titre' name='title' value='".$p->title ."' />
					<br />
					<textarea name='text'>".$p->text ."</textarea>
					<br />
					<input type='submit' value='Ajouter' name='add' />
				</form>
				";
		if(isset($_POST['add'])){
			if(!empty($_POST['title']) && !empty($_POST['text'])){
				$page = new Page();
				$page->id = $p->id;
				$page->title = $_POST['title'];
				$page->text = $_POST['text'];
				$page->date = date('Y-m-d');
				$page->author = 1;
				
				$page->save();
			}
		}
		$wikiView = new WikiView($form);
		$wikiView->render('update');
	}
	
}
