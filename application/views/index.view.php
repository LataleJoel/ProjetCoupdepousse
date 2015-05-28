<?php
defined('__COUPDEPOUCE__')or die('Access Interdit');

?>
<section id="concept" class="clear">
            <div>
                <h2> Pour Partager<br> Bien Plus Des Cours</h2>
            <div id="gros-liens"> 
               <?php if(!Authentification::estConnecte()){?>
                <a  href="?controller=utilisateurs&action=ajouter">S'inscrire</a>
                <a  href="?controller=utilisateurs&action=seconnecter">S'identifier</a>    
            <?php   }
            else if(Authentification::estConnecte()){?>
              <a  href="?controller=utilisateurs&action=deconnecter">Se Déconnecter</a> 
              <br> 
              <br>
           <?php }
?>
            </div> 
            </div>
        </section>
        <section id="informations">
            <div id="description" class="fond-gris">
                <h2 class="titre">Bienvenue sur Coup de Pouce</h2>
                <p>Coup de Pouce est une plateforme collaborative libre de l'ecole d'ingénieurs 3il.<br/>Elle a valoriser l'entraide entre élèves par l'organisation de sessions de  tutorat.</p>
                
            </div>
            
            <div id="etapes" >
                <ul>
                    <li class='etape'>
                        <div>
                            <h2>Etape 1</h2>
                            <div>
                                <img src ="images/pen.png" alt="#">
                            </div>
                            <h3>Creer un compte</h3>
                        </div>
                    </li>
                    <li class='etape'>
                        <div>
                            <h2>Etape 2</h2>
                            <div>
                                <img src ="images/calendar.png" alt="#">
                            </div>
                            <h3>s'inscrire à une session</h3>
                        </div>
                    </li>
                    <li class='etape'>
                        <div>
                            <h2>Etape 3</h2>
                            <div>
                                <img src ="images/thumb.png" alt="#">
                            </div>
                            <h3>Assister à une session</h3>
                        </div>
                    </li>
                </ul>
                <div class="clear"></div>
               
            </div>
            <div id="temoignage" class="fond-gris">
                <h2 class="titre">Un vrai plus dans mon cursus</h2>
                <p>Grâce Coup de Pouce j'ai enfin pu comprendre le TP de web.
                    <br/>Les explications des camarades sont souvent bien plus claires que celles du prof!
                    <span class="signature">Kévin S.</span>
                </p>
            </div>
            <div id="en-vedette">
                <div id='la-selection' class='colonne'>
                    <div>
                        <img src="images/web.jpg" alt="#">
                        <div>Mieux que tout</div>
                    </div>
                    <div>
                        <div>
                            <h2 class='titre'>En vedette</h2>
                            <h3>I2-Web TP 1</h3>
                            <p>Pour tout comprendre du premier TP de Web,le Html,le CSS,la mise en page ainsi que les 
                                astuces de base à connaitre du developpement Web</p>
                        </div>
                    </div>
                </div>
                <div id='prochaines-sessions' class='colonne'>
                    <h2 class='titre'>Prochaines sessions</h2>
                    <ul>
                        <li>
                            <h3><a href="#">I2-Web - CSS</a></h3>
                            <p>Fonctionnement des selecteurs</p>
                            <div class="infos">
                                <p>Date : 22/09/2014 à 17h</p>
                                <p>Lieu : Salle 202</p>
                                <p>Places : 3/6</p>
                            </div>
                        </li>
                        <li>
                            <h3><a href="#">I1-POO - Héritage</a></h3>
                            <p>Pour aller plus loin avec l'ajout et/ou la redéfinition</p>
                            <div class="infos">
                                <p>Date : 22/09/2014 à 17h</p>
                                <p>Lieu : Salle 202</p>
                                <p>Places : 3/6</p>
                            </div>
                        </li>
                        <li>
                            <h3><a href="#">I3-Robotique - Faire parler Nao</a></h3>
                            <p>Utiliser la synthèse vocale du robot</p>
                            <div class="infos">
                                <p>Date : 22/09/2014 à 17h</p>
                                <p>Lieu : Salle 202</p>
                                <p>Places : 3/6</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </section>