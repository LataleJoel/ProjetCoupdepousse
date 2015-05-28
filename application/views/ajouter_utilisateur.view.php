<?php

    defined('__COUPDEPOUCE__') or die('Acces interdit');
    require_once 'framework/helpers/form.helper.php';
    $format=array_merge(array('---'),$this->listeFormations);

 ?>
<section id="ajouter-utilisateur">
    <div class="conteneur">
        <fieldset>
            <legend>
                <h2 class="titre">S'inscrire</h2>
            </legend>
            <form method="POST" action="?controller=utilisateurs&action=ajouter">
                   <?php FormHelper::cleCSRF();?>
                <p class="erreur-form"><?php echo $this->formMessage  ;  ?>              
                </p>        
                <dl>
                    
                    <dt>
                        <label id='nom' for='nom'>Nom : </label>
                    </dt>
                    <dd>
                        <input name="nom" id="nom" type="text" placeholder="Entrer votre Nom" value="<?php echo $this->nom;  ?>" maxlength="256" /> 
                    </dd>

                    <dt>
                        <label id='prenom' for='prenom'>Prénom : </label>
                    </dt>
                    <dd>
                        <input name="prenom" id="prenom" type="text" placeholder="Entrer votre Prenom" value="<?php echo $this->prenom;  ?>" maxlength="256"/> 
                    </dd>
                    
                    <dt>
                        <label id='login' for='login'>Login : </label>
                    </dt>
                    <dd>
                        <input name="login" id="login" type="text" placeholder="Entrer votre Login" value="<?php echo $this->login;  ?>" maxlength="256" /> 
                    </dd>
                    <dt>
                        <label id='mot_de_passe' for='mot_de_passe'>Mot de Passe : </label>
                    </dt>
                    <dd>
                        <input name="mot_de_passe" id="mot_de_passe" type="password" placeholder="Entrer votre Mot De Passe" value="<?php echo $this->mot_de_passe;  ?>" maxlength="256" /> 
                    </dd>
                    <dt>
                     <label id='verification' for='verification'>Confirmation : </label>
                    </dt>
                    <dd>
                        <input name="verification" id="verification" type="password" placeholder="Confirmation" value="<?php echo $this->verification;  ?>" maxlength="256" /> 
                    </dd>
                    <dt>
                        <label id='email' for='email'>Email : </label>
                    </dt>
                    <dd>
                        <input name="email" id="login" type="text" placeholder="Entrer votre Email" value="<?php echo $this->email;  ?>" maxlength="256" /> 
                    </dd>
                     <dt>
                        <label id='formation' for='formation'>Formation: </label>
                    </dt>
                    <dd>
                    <select id='formation' name='formation'>
                      <?php foreach($format as $val){
                          
                             HTMLHelper::option($val,null,$format); 
                        
                         }?>                
                    </select>
                        </dd>
                    <dt> </dt>
                    <dd>
                        <button class="btn" type="submit">Envoyer</button>
                    </dd>
                </dl>    
            </form>
        </fieldset>
    </div>
</section>                    
    
