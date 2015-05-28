<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
 ?>
<section id="se-connecter">
    <div class="conteneur">
        <fieldset>
            <legend>
                <h2 class="titre">S'identifier</h2>
            </legend>
            <form method="POST" action="?controller=utilisateurs&action=seconnecter">
                 <?php FormHelper::cleCSRF();?>
                <p class="erreur-form"><?php echo $this->formMessage  ;  ?>              
                </p>        
                <dl>
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
                    
                    <dt></dt>
                    <dd>
                        <button class="btn" type="submit">Envoyer</button>
                    </dd>
                </dl>    
            </form>
        </fieldset>
    </div>
</section>                    
    
