<?php

namespace wikiapp\view;

use Michelf\Markdown as Markdown;

class WikiView  extends AbstractView{

    /* Constructeur
    *
    * On appelle le constructeur de la classe parent
    *
    */
    public function __construct($data){
        parent::__construct($data);
    }

    /*
     * Retourne le fragment HTML qui réalise une liste de tous les articles dans
     * l'application sous forme d'une liste de titres.
     *
     * Chaque titre est un lien qui permet d'afficher l'article en question.
     *
     * L'attribut $data contient une liste d'objets Page.
     *
     */
    protected function renderAll(){
        $html = "";
        foreach ($this->data as $value){
            $html.="<li><a href='$this->script_name/wiki/view/?title=$value->title'>$value->title</a></li>";
        }
        return "<ul id='menu2'>$html</ul>";

    }

    /*
     * Retourne le fragment HTML qui réalise l'affichage d'un article
     *
     * L'attribut $data contient un objet Page
     * Le text de la page est traduit en HTML par la methode:
     *      \Michelf\Markdown::defaultTransform()
     *
     * L'auteur de la page est récupéré par la méthode gerAuthor() de Page
     *
     */
    protected function renderView(){

		$html =
				"<h1>".$this->data->title ."</h1>".
				Markdown::defaultTransform($this->data->text).
				"Rédigez le ".$this->data->date ." par ".$this->data->author ."
				<br />
				<a href='".$this->script_name ."/wiki/update/?title=".$this->data->title ."'>Modifier</a>";
        return $html;

    }

	protected function renderAdd(){
		return $this->data;
	}

	protected function renderUpdate(){
		return $this->data;
	}

    /*
     * Affiche une page HTML complète.
     *
     * En focntion du sélécteur, le contenu de la page changera.
     *
     */
    public function render($selector){


        switch($selector){
        case 'view':
            $main = $this->renderView();
            break;

        case 'all':
            $main = $this->renderAll();
            break;

        case 'add':
            $main = $this->renderAdd();
            break;

        case 'update':
            $main = $this->renderUpdate();
            break;

        default:
            $main = $this->renderAll();
            break;
        }
        $style_file = $this->app_root.'/html/style.css';

        $header = $this->renderHeader();
        $menu   = $this->renderMenu();
        $footer = $this->renderFooter();


/*
 * Utilisation de la syntaxe HEREDOC pour ecrire la chaine de caractère de
 * la page entière. Voir la documentation ici:
 *
 * http://php.net/manual/fr/language.types.string.php#language.types.string.syntax.heredoc
 *
 * Noter bien l'utilisation des variable dans la chaine de caractère
 *
 */
        $html = <<<EOT
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>MiniWiki</title>
        <link rel="stylesheet" href="${style_file}">
    </head>

    <body>

        <header class="theme-backcolor1"> ${header}  </header>

        <section>

            <aside>

                <nav id="menu" class="theme-backcolor1"> ${menu} </nav>

            </aside>

            <article class="theme-backcolor2">  ${main} </article>

        </section>

        <footer class="theme-backcolor1"> ${footer} </footer>

    </body>
</html>
EOT;

    echo $html;

    }


}
