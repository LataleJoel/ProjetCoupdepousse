<?php
defined('__COUPDEPOUCE__')or die('Acces Interdit');
Application::useHelper('navigation.helper');
Application::useHelper('utilisateur.helper');
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Coup de pouce</title>
        <meta charset="UTF-8">
              <link rel="stylesheet"  MEDIA="screen" TYPE="text/css" href="styles/reset.css" > 
              <link rel="stylesheet"  MEDIA="screen" TYPE="text/css" href="styles/index.css" >
              <link rel="stylesheet"  MEDIA="screen" TYPE="text/css" href="styles/application.css" >
       <?php Page::enteteCSS();?>
    </head>
  
    <body>
        <header id="page-header">
            <div class="conteneur">
                <div id="bloc-logo"  >
                    <img  src="images/coupdepouce_logo.png" alt="logo coup de pouce">     
                </div> 

                <nav id="bloc-navigation">
                    
                <?php NavigationHelper::afficher();?>
                </nav>
            </div>
        </header> 
        <main>         
        <div class="conteneur">
    <section id="application">
        <?php Page::afficherVue();?>
    </section>
    <aside id="subnav"><?php UtilisateurHelper::afficher() ;?>         
    </aside>
</div>
        </main>
<footer id="page-footer">
            
            <div class="conteneur">
               <ul>
                   <li class="footer-links">
                        <h2>Plan du site</h2>
                       <ul>
                           <li > <a href="#">Accueil</a></li> 
                           <li > <a href="#">Prochaines sessions</a></li> 
                           <li > <a href="#">S'identifier</a></li> 
                       </ul>
                   </li>
                    <li class="footer-links">
                        <h2>Liens externes</h2>
                        <ul>
                           <li > <a href="#">3il Ecole d'ingénieurs</a></li> 
                           <li > <a href="#">CS2i</a></li> 
                           <li > <a href="#">Espace Elèves</a></li> 
                       </ul>
                    </li>
                    <li class="footer-links">
                        <h2>Inspiration</h2>
                       <ul>
                           <li > <a href="#">Template Anacron de RocketThemes</a></li> 
                           <li > <a href="#">Joomla</a></li> 
                           <li > <a href="#">Zend Framework</a></li> 
                           <li> <a href="#">Ligature Symboles</a></li>
                       </ul>
                    </li> 
               </ul>
            </div>
            <div class="clear"></div>
        </footer>
    </body>
</html>
