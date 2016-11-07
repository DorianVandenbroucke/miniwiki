<?php

namespace wikiapp\view;

use Michelf\Markdown as Markdown;

class WikiAdminView  extends AbstractView{

    /* Constructeur
    *
    * On appelle le constructeur de la classe parent
    *
    */
    public function __construct($data){
        parent::__construct($data);
    }
   protected function renderAll(){
       $html = "";
       foreach ($this->data as $value){
           $html.="<li><a href='$this->script_name/wiki/view/?title=$value->title'>$value->title</a></li>";
       }
       return "<ul id='menu2'>$html</ul>";

   }

    public function renderLogin(){
      $form = "
            <form method='POST' action='$this->script_name/admin/checkUser/'>
              <input type='text' placeholder='login' name='login' />
              <input type='password' placeholder='password' name='pass' />
              <input type='submit' value='sign in' name='validate' />
            </form>
            Vous n'avez pas encore de compte? <a href='$this->script_name/admin/registration'>Inscrivez-vous</a>.
            ";
      return $form;
    }

    public function render($selector){


        switch($selector){
        case 'login':
            $main = $this->renderLogin();
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
